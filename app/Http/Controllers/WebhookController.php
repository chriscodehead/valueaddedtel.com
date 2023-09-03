<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Settings;
use App\Models\User;
use App\Models\Transaction;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller {

    public static function computeSHA512TransactionHash($stringifiedData) {
        $clientSecret = env('MONNIFY_SECRET_KEY');
        return hash_hmac('sha512', $stringifiedData, $clientSecret);
    }

    function resolve(Request $request){
        $amount = $request['eventData']['amountPaid'];
        
            if(Transaction::where('purpose', $request['eventData']['transactionReference'])->exists()) response('', 200);    
        $bankAccount = BankAccount::where('accountNumber', $request['eventData']['destinationAccountInformation']['accountNumber'])->first();
        
        if(!$bankAccount) return response('', 400);
        
        $user = User::find($bankAccount->user_id);
        $settings = Settings::first();
        
        $user->wallet->main_balance += $amount - $settings->monnify_charge;
        $user->wallet->save();
        

        $amount = $request['eventData']['amountPaid'];
        $narration = "Deposit Ref:".$request['eventData']['transactionReference'];

        // if(!$request->hasHeader('monnify-signature')) return response()->json([], 401);
        // $stringifiedData = json_encode($request->all());
        // $computedHash = $this->computeSHA512TransactionHash($stringifiedData);
        
        // $monnifyHash = $request->header('monnify-signature');
        // if($computedHash !== $monnifyHash) return response()->json([], 401);
        
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'purpose' => $request['eventData']['transactionReference'],
            'amount' => $amount - $settings->monnify_charge,
            'payment_method' => 'Bank Transfer',
            'trans_type' => config('constants.trans_types.deposit'),
            'status' => config('constants.statuses.completed')
        ]);

        // $user->wallet->main_balance += $amount - $settings->monnify_charge;
        // $user->wallet->save();
        $name = env('APP_NAME');

        // Send Transaction Notification
        NotificationService::subject("New Deposit Alert")
                            ->greeting("Dear $user->fullname")
                            ->text("We are pleased to inform you that a new deposit has been made to your account.")
                            ->text("<strong>Deposit Details:</strong>")
                            ->text("<strong>Amount:</strong> &#8358;$amount")
                            ->text("<strong>Account Number:</strong> $bankAccount->accountNumber")
                            ->text("<strong>Narration:</strong> $narration")
                            ->text("Thank you for using our $name. If you have any questions or need further assistance, please feel free to contact our support team.")
                            ->send($user, ['mail']);

        return response('', 200);
    }


    
    

}