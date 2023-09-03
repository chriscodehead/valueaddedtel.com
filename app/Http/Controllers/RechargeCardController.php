<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\RechargeCard;
use App\Services\ClubKonnectService;
use App\Services\LegitDataService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RechargeCardController extends Controller
{   
    use Generics, PaymentTrait, TopUpServices;

    function index(Request $request, ClubKonnectService $clubKonnectService){
        $user = auth()->user();
        
        $recharge_cards = RechargeCard::where('user_id', $user->id)->paginate();
      
        $networks = array_keys($clubKonnectService->rechargePinServices());
        $denominations = $clubKonnectService->denominations;
        return $this->dynamicPage('rechargepins.index')->with(compact('recharge_cards', 'denominations', 'networks'));
    }

    function purchase(Request $request, ClubKonnectService $clubKonnectService){
        $user = auth()->user();

        $request->validate([
            'network' => 'required',
            'quantity' => 'required',
            'amount' => 'required|numeric',
            'denomination' => 'required',
            'pay_service' => 'required|in:wallet,paystack',
            'pin' => 'required|numeric|min:4',
        ]);
      
      if($request->pay_service == 'wallet'){
        $user = auth()->user();
            if($user->wallet->main_balance < ($request->denomination * $request->quantity)) {
                Alert::error("You do not have sufficient funds for this transaction!");
                return back();
            }
        }

        if(!Hash::check($request->pin, $user->pin)) {
            Alert::error("Incorrect Transaction PIN");
            return back();
        }

        $requestId = $this->createUniqueID('recharge_cards', 'reference');

        $data = [
            'network' => $request->network, 
            'denomination' => $request->denomination, 
            'transactionid' => 12423,  
            'amount' => $request->denomination * $request->quantity,
            'quantity' => $request->quantity,
            'request_id' => $requestId,
            'reference' => $requestId,
            'phone' => $user->phone,
            'pay_service' => $request->pay_service
        ];

        session(['billingData' => $data]);

        
        return $this->pay_for_service(
            $request->amount * $request->quantity,
            "Recharge Card Pins",
            $request->pay_service,
            function () use ($data, $clubKonnectService, $user) {
                $data['data'] = $clubKonnectService->rechargeCards($data['network'], $data['denomination'], $data['quantity'], $data['request_id']);
                $data['code'] = $data['data'];

                $transaction = $this->store_vtu_history($data, config("constants.services.recharge_pins"), 'club_connect', 'success');
                $data['transactionid'] = $transaction['id'];
                $data['reference'] = $data['request_id'];
                

                $this->give_cash_back_to_users('recharge_card_cashback', $data['amount']);
                
                $rechargePins = RechargeCard::create([...$data, 'user_id' => $user->id]);

                Alert::success('Your transaction was successful!');
                return to_route('rechargepins.single', ['rechargeCard' => $rechargePins]);
            },
            route('rechargepins.verify')
        );

    }


    function verify(Request $request, ClubKonnectService $clubKonnectService){
        $data = session('billingData');
        $user = auth()->user();
        $result = $this->verify_transaction_paystack($request);

        if ($result['status'] != true) {
            return to_route('rechargepins')->with('errors', 'Payment was not successfull');
        }
        
        $data['data'] = $clubKonnectService->rechargeCards($data['network'], $data['denomination'], $data['quantity'], $data['request_id']);
        $data['code'] = $data['data'];
        
         $transaction = $this->store_vtu_history($data, config("constants.services.recharge_pins"), 'club_connect', 'success');
        $data['transactionid'] = $transaction['id'];
        $data['reference'] = $data['request_id'];
        

        $this->give_cash_back_to_users('recharge_card_cashback', $data['amount']);
        
        $rechargePins = RechargeCard::create([...$data, 'user_id' => $user->id]);
        Alert::success('Your transaction was successful!');
        

        return to_route('rechargepins.single', ['rechargeCard' => $rechargePins]);
    }

    function show(Request $request, RechargeCard $rechargeCard, ClubKonnectService $clubKonnectService) {
      	if(empty($rechargeCard->data)) {
        	  $rechargeCard->data = $clubKonnectService->getRechargePins($rechargeCard->reference);
      		$rechargeCard->save();
        	
        }      	
        
        return $this->dynamicPage('rechargepins.single')->with(compact('rechargeCard'));
    }
}
