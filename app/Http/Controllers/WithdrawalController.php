<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Settings;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\NotificationService;
use App\Services\WithdrawalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawalController extends Controller {
    
    function store(Request $request, WithdrawalService $withdrawalService, NotificationService $notificationService){
        $settings = GeneralSetting::first();

        $request->validate([
            'amount' => "required|numeric|min:$settings->withdrawal_threshold",
            'pin' => 'required|numeric'
        ]);

        $user = $request->user();
        $wallet = $user->wallet;
        
        if(!Hash::check($request->pin, $user->pin)) {
            Alert::error("Incorrect Transaction PIN");
            return back();
        }

        if($wallet->main_balance < $request->amount) {
            Alert::error('You do not have sufficient funds to complete this transaction');
            return back();
        }

        $withdrawal = $withdrawalService->initiate($user, $request->amount);
        
        $wallet->main_balance -= $request->amount;
        $wallet->save();
        $admins = User::isASuperAdmin()->get();

        $notificationService->subject("Urgent: New Withdrawal request")
                            ->text("There is a new withdrawal request of <strong>NGN".number_format($request->amount)."</strong> from $user->full_name")
                            ->text("<strong>Details are as follows:</strong>")
                            ->text("<strong>Wallet Balance:</strong> NGN".number_format($user->wallet->main_balance))
                            ->text("<strong>Withdrawal Amount:</strong> NGN".number_format($request->amount))
                            ->text("<strong>Date:</strong> ".Date::parse($withdrawal->created_at)->format("jS F, Y h:m A"))
                            ->action("View Withdrawals", route('admin.withdrawals'))
                            ->send($admins, ['mail']);

        $notificationService->subject("Urgent: New Withdrawal request")
                            ->text("There is a new withdrawal request of <strong>NGN".number_format($request->amount)."</strong> from $user->full_name")
                            ->text("<strong>Details are as follows:</strong>")
                            ->text("<strong>Wallet Balance:</strong> NGN".number_format($user->wallet->main_balance))
                            ->text("<strong>Withdrawal Amount:</strong> NGN".number_format($request->amount))
                            ->text("<strong>Date:</strong> ".Date::parse($withdrawal->created_at)->format("jS F, Y h:m A"))
                            ->action("View Withdrawals", route('admin.withdrawals'))
                            ->mail(env('MD_EMAIL'));

        Alert::success("Withdrawal Successful! Your funds are on the way.");
        return back();

    }

    function approve(Request $request, Withdrawal $withdrawal, WithdrawalService $withdrawalService, NotificationService $notificationService){
        $request->validate([
            'method' => 'required|string|in:manual,paystack'
        ]);

        //if($withdrawal->user->wallet->main_balance < $withdrawal->amount){
          //  Alert::error('The User does not have sufficient funds to complete this withdrawal');
            //return back();
        //}

        $settings = Settings::first();

        $withdrawalService->approve($withdrawal, $request->method);
        Alert::success("Withdrawal Has been approved successfully!");

        $notificationService->subject("Withdrawal Successful")
                            ->text("We are pleased to confirm that your withdrawal of ₦6,000.00 has been successfully processed and your account is expected to be credited within 5 minutes.")
                            ->text("<strong>Transaction Details:</strong>")
                            ->text("<strong>Reference:</strong> ".$withdrawal->reference)
                            ->text("<strong>Name:</strong> ".$withdrawal->user->full_name)
                            ->text("<strong>Bank:</strong> ".$withdrawal->bank_name)
                            ->text("<strong>Account Number:</strong> ".$withdrawal->account_no)
                            ->text("<strong>Amount:</strong> NGN".number_format($withdrawal->amount))
                            ->text("<strong>Date:</strong> ".Date::parse($withdrawal->created_at)->format('jS F, Y'))
                            ->text("<strong>Time:</strong> ".Date::parse($withdrawal->created_at)->format('h:m:s A'))
                            ->text("<br />")
                            ->text("<br />")
                            ->text("For further enquiries, please contact our customer support through the following channels:")
                            ->text("Email：".($settings->email ?? env('MD_EMAIL')))
                            ->text("Phone：".$settings->phone)
                            ->text("<br/>")
                            ->text("<br/>")
                            ->send($withdrawal->user, ['mail']);

        return back();
    }

    function decline(Request $request, Withdrawal $withdrawal, NotificationService $notificationService){
        $settings = Settings::first();
        $withdrawal->status = config('constants.statuses.declined');
      $withdrawal->save();

        $notificationService->subject("Your withdrawal could not be completed!")
        ->text("We are regret to inform you that your withdrawal could not be completed at this time..")
        ->text("<strong>Reason:</strong>")
        ->text($request->reason)
        ->text("<strong>Transaction Details:</strong>")
        ->text("<strong>Reference:</strong> ".$withdrawal->reference)
        ->text("<strong>Name:</strong> ".$withdrawal->user->full_name)
        ->text("<strong>Bank:</strong> ".$withdrawal->bank_name)
        ->text("<strong>Account Number:</strong> ".$withdrawal->account_no)
        ->text("<strong>Amount:</strong> NGN".number_format($withdrawal->amount))
        ->text("<strong>Date:</strong> ".Date::parse($withdrawal->created_at)->format('jS F, Y'))
        ->text("<strong>Time:</strong> ".Date::parse($withdrawal->created_at)->format('h:m:s A'))
        ->text("<br />")
        ->text("<br />")
        ->text("For further enquiries, Please contact our customer support through the following channels:")
        ->text("Email：".($settings->email ?? env('MD_EMAIL')))
        ->text("Phone".$settings->phone)
        ->text("<br/>")
        ->text("<br/>")
        ->send($withdrawal->user, ['mail']);
        Alert::success("Withdrawal Has been declined successfully!");
        return back();
    }

    function webhook(Request $request, WithdrawalService $withdrawalService){
        if(!$request->hasHeader('x-paystack-signature')) return response('', 401);

        $hash = Hash::make(env('PAYSTACK_TEST_SK'));

        if($hash === $request->header('x-paystack-signature')) {
            $withdrawalService->verify($request->all());
            return response('', 200);
        }
        
        return response('', 401);
    }
  
  function destroy(Withdrawal $withdrawal){
    $withdrawal->delete();
    alert()->success('Withdrawal Deleted Successfully!');
    return back();
  }

}
