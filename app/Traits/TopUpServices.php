<?php

namespace App\Traits;

use App\Events\AfterVtuTopUp;
use App\Models\GeneralSetting;
use App\Models\LevelCommission;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VtuHistory;
use App\Models\Wallet;
use App\Services\ClubKonnectService;
use App\Services\ReferralService;
use App\Services\VtPassService;

trait TopUpServices
{
    use Generics;
    use ThirdParty;
    use PaymentTrait;

    public function buyDataService($data)
    {
        $data['request_id'] = $this->generateRequestID();
        $result = $this->buy_data_sub($data);
        
        if ($result['status'] == "success") {
            $this->store_vtu_history($data, config("constants.services.data"), 'topup_access', $result['status']);
            if ($data['amount'] >= 200) {
                $user = User::find(auth()->user()->id);
                AfterVtuTopUp::dispatch($data['amount'], $user);
            }
            $this->give_cash_back_to_users('data_cash_back', $data['amount']);
            return $result;
        }
        if ($result['status'] == "failed") {
            abort(redirect()->back()->with('errors', $result['message']));
        } else {
            abort(redirect()->back()->with('errors', "Something went wrong. Please try again later"));
        }
    }

    public function buyAirtimeService($data)
    {
        $data['request_id'] = $this->generateRequestID();
        $postFields = array('request_id' => $data['request_id'], 'serviceID' => $data['network'], 'amount' => $data['amount'], 'phone' => $data['phone']);

        $clubKonnect = new ClubKonnectService();
        $result = $clubKonnect->airtime($data['network'], $data['amount'], $data['phone'], $data['request_id']);
        // $request = VtPassService::authorize()->post('/pay', $postFields);
        // $result = VtPassService::response($request);

      	if (!$result) {
            abort(redirect()->back()->with('errors', "There's an issue on this request. \nPlease try again later"));
        }
        
        // if ($result['code'] != 000) {
        //     abort(redirect()->back()->with('errors', $result['response_description'] . "\nPlease confirm details and try again"));
        // }     
        
        //give a certain % charge back to customer
        $this->give_cash_back_to_users('airtime_cash_back', $data['amount']);
        
        $this->store_vtu_history($data, config("constants.services.airtime"), 'vtpass', "success");
        
        // if ($data['amount'] >= 1000) {
        //     $user = User::find(auth()->user()->id);
        //     AfterVtuTopUp::dispatch($data['amount'], $user);
        // }
        return $result;
    }

    public function buyCableSubscription($data)
    {
        $postFields = array('request_id' => $data['request_id'], 'serviceID' => $data['serviceID'], 'billersCode' => $data['billersCode'], 'phone' => $data['phone'], 'variation_code' => $data['variation_code'], 'subscription_type' => $data['subscription_type']);

        // $result = $this->vtpassPostEndpoints(env("VTPASS_TEST_URL") . '/pay', $postFields);
        $response = VtPassService::authorize()->post('//pay', $postFields);
        $result = VtPassService::response($response);

        // if (!$result) {
        //     abort(redirect()->back()->with('errors', "There's an issue on this request. \nPlease try again later"));
        // }

        // if ($result['code'] != 000) {
        //     abort(redirect()->back()->with('errors', $result['response_description'] . "\nPlease confirm details and try again"));
        // }
        
        //give a certain % charge back to customer
        $this->give_cash_back_to_users('cable_cashback', $data['amount'], 'fixed');

        $this->store_vtu_history($data, config("constants.services.cable"), 'vtpass', "success");
        return $result;
    }


    private function store_vtu_history($data, $service, $vtu_provider, $status) 
    {
        return VtuHistory::create([
            'user_id' => auth()->user()->id,
            'service' => $service,
            'amount' => $data['amount'],
            'phone' => $data['phone'],
            'request_id' => $data['request_id'],
            'vtu_plan' => isset($data['vtu_plan']) ? $data['vtu_plan'] : null,
            'vtu_provider' => $vtu_provider,
            'network' => isset($data['network']) ? $data['network'] : null,
            'payment_method' => $data['pay_service'],
            'status' => $status,
            'code' => $data['purchased_code'] ?? null
        ]);
    }

    private function give_cash_back_to_users($service, $amount, $type = 'percent'): void
    {
        $user = auth()->user();
        $cash_back = GeneralSetting::where('title', $service)->first('value');
        $referral_cash_back = GeneralSetting::where('title', $service.'_referrer')->first('value');
        $user_wallet = $user->wallet;
        
        if($user->referrer && $referral_cash_back){
            $levels = LevelCommission::all();
            ReferralService::pay($user->referrer, $type == 'percent' ? $referral_cash_back['value'] * $amount : $referral_cash_back['value'] * $amount, $levels);
        }

        $amount = $type == 'percent' ? $cash_back['value'] * $amount : $cash_back['value'];

        $user_wallet->cash_back +=  $amount;
        $user_wallet->save(); 
        $user_wallet->refresh();

        Transaction::create([
            'user_id' => $user->id,
            'purpose' => str($service)->headline(),
            'amount' => $amount,
            'payment_method' => 'cashback',
            'trans_type' => "Cashback",
            'status' => 'success',
            'prev_bal' => $user_wallet->main_balance - $amount,
            'new_bal' => $user_wallet->main_balance
        ]);
    }
}
