<?php

namespace App\Http\Controllers;

use App\Models\VtuHistory;
use App\Services\SmileService;
use App\Services\VtPassService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\ThirdParty;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SmileController extends Controller
{
    use Generics, TopUpServices, PaymentTrait, ThirdParty;
    
    function index(SmileService $smileService){

        $vtu_histories = VtuHistory::where('user_id', auth()->user()->id)->where('service', config('constants.services.smile'))->orderBy('created_at', 'desc')->paginate(5, ['*'], 'vtu_histories');

        $plans = $smileService->plans();

        return $this->dynamicPage('smile.index')->with(compact('vtu_histories', 'plans'));
    }

    function purchase(Request $request, SmileService $smileService){
        $user = auth()->user();

        $request->validate([
            'plan' => 'required',
            'amount' => "required|numeric",
            'smile_mail' => "required|email",
            'pay_service' => 'required|in:wallet,paystack',
            'pin' => 'required|numeric|min:4',
            'name' => 'required|string',
            'account' => 'required',
            'phone' => 'required|numeric'
        ]);
      
      $currVariation = Arr::first($plans, fn ($item) => $item['variation_code'] == $plan[0]);
      
      if(!$currVariation) {
            alert()->error('Invalid Service Selected!');
            return back();
      }
      
      $request->replace(['amount' => $currVariation['variation_amount']]);
      
      if($request->pay_service == 'wallet'){
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
      
      

        $reference = $this->generateRequestID();
        $plan = explode('/', $request->plan);

        $data = [
            'request_id' => $reference,
            'serviceID' => 'smile-direct',
            'billersCode' => $request->account,
            'variation_code' => $plan[0],
            'amount' => $request->amount,
            'phone' => $request->phone,
            'pay_service' => $request->pay_service,
            'email' => $user->email,
            'network' => 'Smile',
            'vtu_plan' => $plan[1]
        ];

        session(['billingData' => $data]);

        // dd($data);

        
        return $this->pay_for_service(
            $request->amount,
            $plan[1],
            $request->pay_service,
            function () use ($data, $smileService, $user) {
                $response = $smileService->purchase($data, to_route('smile'));
                                
                $transaction = $this->store_vtu_history($data, config("constants.services.smile"), 'vtpass', 'success');

                Alert::success('Your transaction was successful!');
                return back();
            },
            route('smile.verify')
        );
    }

    function verifyAccount(Request $request, $email, SmileService $smileService){
        $status = $smileService->verify($email, 'smile-direct');
        return response($status);
    }

    function verify(Request $request, SmileService $smileService){
        $user = auth()->user();

        $data = session('billingData');
        $result = $this->verify_transaction_paystack($request);

        if ($result['status'] != true) {
            return to_route('smile')->with('errors', 'Payment was not successfull');
        }

        $res = $smileService->purchase($data, to_route('smile'));

        $transaction = $this->store_vtu_history($data, config("constants.services.smile"), 'vtpass', 'success');
        
        Alert::success('Your transaction was successful!');

        return to_route('smile');
    }

}
