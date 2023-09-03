<?php

namespace App\Http\Controllers;

use App\Models\Comission;
use App\Models\Education;
use App\Models\GeneralSetting;
use App\Services\EducationService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class EducationController extends Controller {
    use Generics, PaymentTrait, TopUpServices;

    function index(EducationService $educationService) {
        $user = auth()->user();

        $waec = $educationService->load('waec');
        //$waecReg = $educationService->load('waec-registration');
        $jamb = $educationService->load('jamb');
        
        $vtu_histories = $user->vtuHistories()
                ->where('service', config('constants.services.education'))
                ->orderBy('created_at', 'desc')
                ->paginate(5, ['*'], 'vtu_histories');

        return $this->dynamicPage('education.education')->with(compact('waec', 'jamb', 'vtu_histories'));
    }

    function single($service, EducationService $educationService){
        $user = auth()->user();
        $service = $educationService->load($service);
        
        $vtu_histories = $user->vtuHistories()
                                ->where('service', config('constants.services.education'))
                                ->orderBy('created_at', 'desc')
                                ->paginate(5, ['*'], 'vtu_histories');

        return $this->dynamicPage('education.education-single')->with(compact('service', 'vtu_histories'));
    }
    
    
    function store(Request $request, $service_id, EducationService $educationService){
        $user = auth()->user();

        $request->validate([
            'service' => "required|string",
            'amount' => "required|numeric",
            "quantity" => "required|numeric|min:1",
            'payment_method' => 'required|in:wallet,paystack',
            'pin' => 'required|numeric|min:4',
            'jamb_pin' => Rule::requiredIf($service_id == 'jamb')
        ]);
      
      $service = $educationService->load($service_id);

        $currVariation = Arr::first($service['variations'], fn ($item) => $item['variation_code'] == $request->service);
		
      if(!$currVariation) {
            alert()->error('Invalid Service Selected!');
            return back();
        }
      
      $request->replace(['amount' => $currVariation['variation_amount']]);
      
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

        $service = $educationService->load($service_id);

        $currVariation = Arr::first($service['variations'], fn ($item) => $item['variation_code'] == $request->service);

        $reference = $this->generateRequestID();
        $data = [
            'request_id' => $reference,
            'serviceID' => $service_id,
            'variation_code' => $request->service,
            'quantity' => $request->quantity,
            'phone' => $user->phone,
            'email' => $user->email,
            "amount" => $currVariation['variation_amount'],
            'pay_service' => $request->payment_method,
            'billersCode' => $request->jamb_pin
        ];

        session(['billingData' => $data]);

        return $this->pay_for_service(
            $currVariation['variation_amount'],
            "Electricity Purchase",
            $request->payment_method,
            function () use ($data, $educationService, $user) {
                $response = $educationService->purchase($data);
                $cash_back = GeneralSetting::where('title', 'education')->first('value');

                $data['purchased_code'] = $response['purchased_code'];

                $user->wallet->cash_back += $cash_back['value'];
                $user->wallet->save();
                
                $transaction = $this->store_vtu_history($data, config("constants.services.education"), 'vtpass', 'success');
                
                Education::create([
                    'amount' => $data['amount'],
                    'transaction_id' => $transaction->id,
                    'code' => $response['purchased_code'],
                    'pin' => $data['billersCode'] ?? null,
                    'service' => $data['serviceID']
                ]);

                Alert::success('Your purchase was successful!', $response['purchased_code']);
                return redirect(route('single-history', ['history' => $transaction->id]));;
            },
            route('education.verify')
        );
    }

    function verify(Request $request, EducationService $educationService){
        $user = auth()->user();
        
        $data = session('billingData');
        $result = $this->verify_transaction_paystack($request);

        if ($result['status'] != true) {
            return redirect(route('education'))->with('errors', 'Payment was not successfull');
        }

        $res = $educationService->purchase($data);
        $data['purchased_code'] = $res['purchased_code'];
        
        $transaction = $this->store_vtu_history($data, config("constants.services.education"), 'vtpass', 'success');
        
        Education::create([
            'amount' => $data['amount'],
            'transaction_id' => $transaction->id,
            'code' => $res['purchased_code'],
            'pin' => $data['billersCode'] ?? null,
            'service' => $data['serviceID']
        ]);

        $cash_back = GeneralSetting::where('title', 'education')->first('value');
        
        $user->wallet->cash_back += $cash_back['value'];
        $user->wallet->save();

        Alert::success('Your purchase was successful!', $res['purchased_code']);

        return redirect(route('single-history', ['history' => $transaction->id]));
    }

}
