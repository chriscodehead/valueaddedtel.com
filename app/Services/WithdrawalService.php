<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Traits\Generics;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawalService {
    use Generics;

    // account_number
    // account_name
    // bank_name

    function createRecipient(User $user){
        $data = [
            "type" => "nuban", 
            "name" => $user->account_name, 
            "account_number" => $user->account_number, 
            "bank_code" => $user->bank_code, 
            "currency" => "NGN"
        ];

        $response = Http::withHeaders([
            'Content-Type' => "application/json",
            'Authorization' => "Bearer " . env('PAYSTACK_TEST_SK'),
        ])->post(implode('/', [env('PAYSTACK_URL'), 'transferrecipient']), $data)->collect();
        if(!$response['status']) return [false, $response['message']]; 
        
        return [true, $response['data']['recipient_code']];
        
    }

    function initiate(User $user, $amount){
        $reference = $this->generateId();

        $transaction =  Transaction::create([
            'user_id' => $user->id,
            'purpose' => "Fund Withdrawal",
            'amount' => $amount,
            'payment_method' => 'wallet',
            'trans_type' => config('constants.trans_types.withdraw'),
            'status' => config('constants.statuses.pending')
        ]);


        return Withdrawal::create([
            'reference' => $reference,
            'amount' => $amount,
            'transaction_id' => $transaction->id,
            'user_id' => $user->id,
            'status' => config('constants.statuses.pending'),
            'account_status' => config('constants.statuses.initiated'),
            'bank_name' => $user->bank_name,
            'account_no' => $user->account_number,
            'account_name' => $user->account_name
        ]);
    }

    function verify($data){
        if(!$withdrawal = Withdrawal::where('reference', $data['data']['reference'])->first()) return;

        if($data['event'] == 'transfer.success') $this->complete($withdrawal, config('constants.statuses.completed'));

        if($data['event'] == 'transfer.failed') {
            $this->complete($withdrawal, config('constants.statuses.failed'));
            
            $wallet = $withdrawal->user->wallet;
            
            $wallet->main_balance += $withdrawal->amount;
            $wallet->save();
            
        }

        if($data['event'] == 'transfer.reversed') {
            $withdrawal->account_status = 'reversed';
            $withdrawal->save();
        }
    }

    function approve(Withdrawal $withdrawal, $method){
        $user = $withdrawal->user;

        if($method == 'paystack'){
            $recipient = $this->createRecipient($user);
    
            if(!$recipient[0]) return $recipient;
    
            $data = [
                'source' => "balance",
                'amount' => $withdrawal->amount,
                "reference" => $withdrawal->reference,
                'recipient' => $recipient[1],
                'reason' => "Withdrawal from Xtravalue",
            ];
    
            $response = Http::withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . env('PAYSTACK_TEST_SK'),
            ])->post(implode('/', [env('PAYSTACK_URL'), 'transfer']), $data)->collect();
    
            if(!$response['data']['status'] !== 'success') {
                alert()->error($response['message']);
                return abort(back());
            } 

            $withdrawal->transfer_code = $response->data->transfer_code;
            $withdrawal->save();
        }else if($method == 'manual'){
            $this->complete($withdrawal, config('constants.statuses.completed'));
          	
        }else{
            Alert::error("Invalid Payment Method Selected");
            abort(back());
        }

        return true;
    }

    function complete(Withdrawal $withdrawal, $status){
        $withdrawal->status = $status;
        $withdrawal->account_status = $status;
        $withdrawal->save();
		$transaction = $withdrawal->transaction;
        
      	if($transaction) {
            $transaction->status = $status;
            $transaction->save();
        }
    }




}