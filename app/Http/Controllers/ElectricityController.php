<?php

namespace App\Http\Controllers;

use App\Models\Comission;
use App\Models\Electricity;
use App\Models\ElectricityCompany;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Services\ElectricityService;
use App\Services\PaymentService;
use App\Traits\Generics;
use App\Traits\Responses;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ElectricityController extends Controller
{
    use Generics, TopUpServices;

    public function index() {
        $user = auth()->user();
        $companies = ElectricityCompany::all();

        $vtu_histories = $user->vtuHistories()
                ->where('service', config('constants.services.electricity'))
                ->orderBy('created_at', 'desc')
                ->paginate(5, ['*'], 'vtu_histories');

        return $this->dynamicPage('electricity.electricity')->with(compact('companies','vtu_histories' ));
    }

    public function create() {
        //
    }

    public function store(Request $request, ElectricityService $electricityService, PaymentService $paymentService) {
        $user = auth()->user();
        $reference = $this->generateRequestID();

        $request->validate([
            'company' => 'required',
            'type' => 'required|in:prepaid,postpaid',
            'meter_no' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:wallet,paystack',
            'pin' => 'required|numeric|min:4',
        ]);
      //required|numeric
      
      
      
      if($request->payment_method == 'wallet'){
        $user = auth()->user();
            if($user->wallet->main_balance < $request->amount) {
                Alert::error("You do not have sufficient funds for this transaction!");
                return back();
            }
        }

        if(!Hash::check($request->pin, $user->pin)) {
            Alert::error("Incorrect Transaction PIN");
            return back();
        }

        $company = ElectricityCompany::find($request->company);

        $data = [
            'meter_no' => $request->meter_no,
            'service_id' => $company->service_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'user' => $user,
            'payment_method' => $request->payment_method,
            'phone' => $user->phone,
            'request_id' => $reference,
            'pay_service' => $request->payment_method,
            'company' => $company,
            'network' => $company->name
        ];

        $info = $electricityService->verify($data);
      	$data['customer_name'] = $info['Customer_Name'];
      	$data['address'] = $info['Address'];

        //store data in session
        session(['billingData' => $data]);

        return $this->pay_for_service(
            $request->amount,
            "Electricity Purchase",
            $request->payment_method,
            function () use ($data, $electricityService, $user) {
                $info = $electricityService->purchase($user, $data);
                $user_cash_back = GeneralSetting::where('title', 'electricity')->first('value');
                $user->wallet->cash_back += $user_cash_back['value'] * $data['amount'];
                $user->wallet->save();

                $data['purchased_code'] = $info['token'] ?? $info['mainToken'] ?? $info['purchased_code'] ?? null;
                
                $transaction = $this->store_vtu_history($data, config("constants.services.electricity"), 'vtpass', 'success');
              
                Electricity::create([
                  'company_id' => $data['company']->id, 
                    'meter' => $data['type'], 
                    'meter_no' => $data['meter_no'], 
                    'amount' => $data['amount'], 
                    'transaction_id' => $transaction->id, 
                  	'customer_name' => $data['customer_name'],
                  	'address' => $data['address'],
                    'purchased_code' => $info['token'] ?? $info['mainToken'] ?? $info['purchased_code'] ?? null, 
                    'units' => $info['units'] ?? $info['mainTokenUnits'] ?? null
                ]);
              
                Transaction::create([
                    'user_id' => $user->id,
                    'purpose' => 'Electricity Cashback',
                    'amount' => $user->wallet->cash_back,
                    'payment_method' => 'wallet',
                    'trans_type' => 'Cashback',
                    'status' => 'Completed',
                    'prev_bal' => $user->wallet->cash_back - ($user_cash_back['value'] * $data['amount']),
                    'new_bal' => $user->wallet->cash_back
                ]);
              
                Alert::success('Your Electricity Bill purchase was successful!');
              	return redirect(route('single-history', ['history' => $transaction->id]));
                //return redirect()->back()->with('success', 'Your Electricity Bill purchase was successful!');
            },
            route('electricity.verify')
        );                
    }
    
    function verify(Request $request, ElectricityService $electricityService){
        $user = auth()->user();

        $data = session('billingData');
        
        $result = $this->verify_transaction_paystack($request);
        
        if ($result['status'] != true) {
            return redirect(route('electricity'))->with('errors', 'Payment was not successfull');
        }
        $info = $electricityService->purchase($data['user'], $data);
        $data['purchased_code'] = $info['token'] ?? $info['mainToken'] ?? $info['purchased_code'] ?? null;
        
        $transaction = $this->store_vtu_history($data, config("constants.services.electricity"), 'vtpass', 'success');
      
        Electricity::create([
            'company_id' => $data['company']->id, 
            'meter' => $data['type'], 
            'meter_no' => $data['meter_no'], 
            'amount' => $data['amount'], 
            'transaction_id' => $transaction->id, 
            'purchased_code' => $info['token'] ?? $info['mainToken'] ?? $info['purchased_code'] ?? null, 
            'units' => $info['units'] ?? $info['mainTokenUnits'] ?? null
        ]);

        $user_cash_back = GeneralSetting::where('title', 'electricity')->first('value');
        
        $user->wallet->cash_back += $user_cash_back['value'] * $data['amount'];
        $user->wallet->save();
      
      Transaction::create([
        'user_id' => $user->id,
        'purpose' => 'Electricity Cashback',
        'amount' => $user->wallet->cash_back,
        'payment_method' => 'wallet',
        'trans_type' => 'Cashback',
        'status' => 'Completed',
        'prev_bal' => $user->wallet->cash_back - ($user_cash_back['value'] * $data['amount']),
        'new_bal' => $user->wallet->cash_back
      ]);

        Alert::success('Your Electricity Bill purchase was successful!');

        return redirect(route('single-history', ['history' => $transaction->id]));;
    }

    public function show(Electricity $electricity)
    {
        //
    }

    public function edit(Electricity $electricity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Electricity  $electricity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Electricity $electricity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Electricity  $electricity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Electricity $electricity)
    {
        //
    }
}
