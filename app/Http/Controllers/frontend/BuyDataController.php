<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyDataRequest;
use App\Models\DataPrincing;
use App\Models\GeneralSetting;
use App\Models\Network;
use App\Models\VtuHistory;
use App\Models\Wallet;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\Responses;
use App\Traits\ThirdParty;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class BuyDataController extends Controller
{
    use Generics, Responses, TopUpServices, PaymentTrait, ThirdParty;

    public function buyData()
    {
        $networks = ['networks' => Network::all()];
        $vtu_histories = ['vtu_histories' => VtuHistory::where('user_id', auth()->user()->id)->where('service', config('constants.services.data'))->orderBy('created_at', 'desc')->paginate(5, ['*'], 'vtu_histories')];
        return $this->dynamicPage('vtu.buy-data')->with($networks)->with($vtu_histories);
    }

    public function getPlanType(string $network)
    {
        $plan_types = DataPrincing::where('network', $network)->distinct('plan_type')->pluck('plan_type');
        return response()->json($plan_types);
    }

    public function getPlan(string $planType)
    {
        $expl = explode('-', $planType);
        $plans = DataPrincing::where('network', $expl[1])->where('plan_type', $expl[0])->get();
        return response()->json($plans);
    }

    public function allPlans()
    {
        $plans = DataPrincing::all();
        return response()->json($plans);
    }

    public function buyNow(BuyDataRequest $request)
    {
        $data = $this->validatingRequest($request);
      
      if($request->pay_service == 'wallet'){
        $user = auth()->user();
            if($user->wallet->main_balance < $request->amount) {
                Alert::error("You do not have sufficient funds for this transaction!");
                return back();
            }
        }
        $data['amount'] = intval(str_replace(',', '', $data['amount']));

        $expPlan = explode('/', $data['plan_type']);
        $data['plan_type'] = $expPlan[0];
        $data['vtu_plan'] = $expPlan[1];
      
      

        $check = Hash::check($data['pin'], auth()->user()->pin);
        if (!$check) {
            return back()->with('errors', "Incorrect Transaction PIN");
        }

        $charge = GeneralSetting::where('title', 'data_charge')->first('value');
        $chargedAmount = $data['amount'] + ($data['amount'] * $charge['value']);
        $data['chargedAmount'] = $chargedAmount;

        //store data in session
        session(['internetData' => $data]);

        return $this->pay_for_service(
            $chargedAmount,
            "Data Plan Puchase",
            $data['pay_service'],
            function () use ($data) {
                $result = $this->buyDataService($data);
                return redirect()->back()->with('success', 'Congratulations, ' . $result['message']);
            },
            route('verify-data-sub')
        );
    }

    public function verifyDataSub(Request $request)
    {
        $data = session('internetData');
        $result = $this->verify_transaction_paystack($request);
        if ($result['status'] != true) {
            return redirect()->back()->with('errors', 'Payment was not successfull');
        }
        $result = $this->buyDataService($data);
        return redirect()->back()->with('success', 'Congratulations, ' . $result['message']);
    }
}
