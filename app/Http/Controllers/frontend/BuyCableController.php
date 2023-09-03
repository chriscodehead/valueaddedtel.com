<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyCableRequest;
use App\Models\VtuHistory;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\Responses;
use App\Traits\ThirdParty;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class BuyCableController extends Controller
{
    use Generics, Responses, ThirdParty, TopUpServices, PaymentTrait;
    public function cable(Request $request)
    {
        $serviceID = ['serviceID' => $request->serviceID];
        $result = $this->getVariationCodesFromVtPass($request->serviceID);
        $service_name = ['service_name' => $result['content']['ServiceName']];
        $varations = ['variations' => $result['content']['varations']];
        $vtu_histories = ['vtu_histories' => VtuHistory::where('user_id', auth()->user()->id)->where('service', config('constants.services.cable'))->orderBy('created_at', 'desc')->paginate(5, ['*'], 'vtu_histories')];

        return $this->dynamicPage('vtu.cable')->with($serviceID)->with($service_name)->with($vtu_histories)->with($varations);
    }

    public function buyCable(BuyCableRequest $request)
    {
        $data = $this->validatingRequest($request);
        $check = Hash::check($data['pin'], auth()->user()->pin);
        if (!$check) {
            return back()->with('errors', "Incorrect Transaction PIN");
        }
      
      if($request->pay_service == 'wallet'){
        $user = auth()->user();
            if($user->wallet->main_balance < $request->amount) {
                Alert::error("You do not have sufficient funds for this transaction!");
                return back();
            }
        }
      
        $deduceCode = $this->deduceAmountFromVariationCode($data['variation_code']);
        //verify the smartcard number
        $result = $this->verifyTVCardNumber($data, $deduceCode);
        //redirect to confirmation screen
        return redirect()->route('cable-confirm');
    }

    public function cableConfirm()
    {
        return $this->dynamicPage('vtu.cable-confirm');
    }

    public function submitCable()
    {
      	if(session('pay_method') == 'wallet'){
            $user = auth()->user();
                if($user->wallet->main_balance < session('amount')) {
                    Alert::error("You do not have sufficient funds for this transaction!");
                    return back();
                }
        }
        $data = [
            'serviceID' => session('serviceID'),
            'pay_service' => session('pay_method'),
            'phone' => session('phone'),
            'request_id' => $this->generateRequestID(),
            'vtu_plan' => session('plan'),
            'chargedAmount' => session('chargedAmount'),
            'amount' => session('amount'),
            'variation_code' => session('variation_code'),
            'billersCode' => session('billersCode'),
            'subscription_type' => session('subscription_type') ? session('subscription_type') : null
        ];
        session(['cableData' => $data]);
        return $this->pay_for_service(
            $data['chargedAmount'],
            session('serviceID') . " Subscription",
            $data['pay_service'],
            function () use ($data) {
                $result = $this->buyCableSubscription($data);
                return redirect()->route('dashboard')->with('success', 'Subscription was successful');
            },
            route('verify-cable-sub')
        );
    }

    public function verifyCableSub(Request $request)
    {
        $data = session('cableData');
        $result = $this->verify_transaction_paystack($request);
        if ($result['status'] != true) {
            return redirect()->back()->with('errors', 'Payment was not successfull');
        }
        $result = $this->buyCableSubscription($data);
        return redirect()->route('dashboard')->with('success', 'Subscription was successful');
    }
}
