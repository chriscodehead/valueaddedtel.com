<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyAirtimeRequest;
use App\Models\AirtimeNetwork;
use App\Models\GeneralSetting;
use App\Models\Network;
use App\Models\VtuHistory;
use App\Services\ClubKonnectService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\Responses;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class BuyAirtimeController extends Controller
{
    use Generics, Responses, TopUpServices, PaymentTrait;

    public function airtime(ClubKonnectService $clubKonnectService)
    {
        $networks = array_keys($clubKonnectService->rechargePinServices());
        $vtu_histories = ['vtu_histories' => VtuHistory::where('user_id', auth()->user()->id)->where('service', config('constants.services.airtime'))->orderBy('created_at', 'desc')->paginate(5, ['*'], 'vtu_histories')];
        return $this->dynamicPage('vtu.airtime')->with(compact('networks'))->with($vtu_histories);
    }

    public function buyNow(BuyAirtimeRequest $request)
    {
        $data = $this->validatingRequest($request);
        $check = Hash::check($data['pin'], auth()->user()->pin);
      
      if($request->pay_service == 'wallet'){
        $user = auth()->user();
            if($user->wallet->main_balance < $request->amount) {
                Alert::error("You do not have sufficient funds for this transaction!");
                return back();
            }
        }
      
        if (!$check) {
            return back()->with('errors', "Incorrect Transaction PIN");
        }
        $data['serviceID'] = $data['network'];
        $charge = GeneralSetting::where('title', 'airtime_charge')->first('value');
        $chargedAmount = $data['amount'] + ($data['amount'] * $charge['value']);
        $data['chargedAmount'] = $chargedAmount;

        //store data in session
        session(['airtimeData' => $data]);

        return $this->pay_for_service(
            $chargedAmount,
            "Airtime Puchase",
            $data['pay_service'],
            function () use ($data) {
                $result = $this->buyAirtimeService($data);
                return redirect()->back()->with('success', 'Airtime Recharge was Successfull');
            },
            route('verify-airtime-sub')
        );
    }

    public function verifyAirtimeSub(Request $request)
    {
        $data = session('airtimeData');
        $result = $this->verify_transaction_paystack($request);
        if ($result['status'] != true) {
            return redirect()->back()->with('errors', 'Payment was not successfull');
        }
        $result = $this->buyAirtimeService($data);
        return redirect()->back()->with('success', 'Airtime Recharge was Successfull');
    }
}
