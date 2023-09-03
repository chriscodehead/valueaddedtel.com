<?php

namespace App\Http\Controllers;

use App\Models\VtuHistory;
use App\Services\ShowmaxService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\ThirdParty;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ShowmaxController extends Controller
{
    use Generics, TopUpServices, PaymentTrait, ThirdParty;
    
    function index(ShowmaxService $showmaxService){

        $vtu_histories = VtuHistory::where('user_id', auth()->user()->id)->where('service', config('constants.services.showmax'))->orderBy('created_at', 'desc')->paginate(5, ['*'], 'vtu_histories');

        $variations = $showmaxService->plans();

        return $this->dynamicPage('showmax.index')->with(compact('vtu_histories', 'variations'));
    }

    function purchase(Request $request, ShowmaxService $showmaxService){
        $user = auth()->user();

        $request->validate([
            'plan' => 'required',
            'amount' => "required|numeric",
            'pay_service' => 'required|in:wallet,paystack',
            'pin' => 'required|numeric|min:4',
            'phone' => 'required|numeric'
        ]);
      
      	if(!Hash::check($request->pin, $user->pin)) {
            Alert::error("Incorrect Transaction PIN");
            return back();
        }
      
      	$plan = explode('/', $request->plan);
      
      	$plans = $showmaxService->plans();
        $currVariation = Arr::first($plans, fn ($item) => $item['variation_code'] == $plan[2]);
      
      if(!$currVariation) {
            alert()->error('Invalid Service Selected!');
            return back();
        }
      
      	if($request->pay_service == 'wallet'){
        	$user = auth()->user();
            if($user->wallet->main_balance < $currVariation['variation_amount']) {
              Alert::error("You do not have sufficient funds for this transaction!");
              return back();
            }
        }

        $reference = $this->generateRequestID();

        $data = [
            'request_id' => $reference,
            'serviceID' => 'showmax',
            'billersCode' => $request->phone,
            'variation_code' => $plan[2],
            'amount' => $currVariation['variation_amount'],
            'phone' => $request->phone,
            'pay_service' => $request->pay_service,
            'email' => $user->email,
            'network' => 'Showmax',
            'vtu_plan' => $plan[0]
        ];

        session(['billingData' => $data]);

        // dd($data);

        
        return $this->pay_for_service(
            $request->amount,
            $plan[2],
            $request->pay_service,
            function () use ($data, $showmaxService, $user) {
                $response = $showmaxService->purchase($data, to_route('showmax'));
                                
                $transaction = $this->store_vtu_history($data, config("constants.services.showmax"), 'vtpass', 'success');

                Alert::success('Your transaction was successful!');
                return back();
            },
            route('showmax.verify')
        );
    }


    function verify(Request $request, ShowmaxService $showmaxService){
        $user = auth()->user();

        $data = session('billingData');
        $result = $this->verify_transaction_paystack($request);

        if ($result['status'] != true) {
            return to_route('showmax')->with('errors', 'Payment was not successfull');
        }

        $res = $showmaxService->purchase($data, to_route('showmax'));

        $transaction = $this->store_vtu_history($data, config("constants.services.showmax"), 'vtpass', 'success');
        
        Alert::success('Your transaction was successful!');

        return to_route('showmax');
    }
}
