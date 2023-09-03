<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class TransferController extends Controller
{

    public function store(Request $request){

        $request->validate([
            'username' => ['required', 'exists:users,username'],
            'amount' => 'required|numeric',
            'pin' => 'required|max:4'
        ]);

        $user = $request->user();

        if(!Hash::check($request->pin, $user->pin)) {
            Alert::error("Incorrect Transaction PIN");
            return back();
        }

        if($request->username === $user->username) {
            Alert::error('You cannot make transfers to your own wallet!');
            return back();
        }

        if($user->wallet->main_balance < $request->amount) {
            Alert::error('You do not have sufficient funds for this transaction!');
            return back();
        }

        if(!$reciever = User::where('username', $request->username)->first()) {
            Alert::error("Account does not exist with username $request->username!");
            return back();
        }


        $reciever->wallet->main_balance += $request->amount;
        $reciever->wallet->save();

        $user->wallet->main_balance -= $request->amount;
        $user->wallet->save();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'purpose' => "Intra-App Transfer",
            'amount' => $request->amount,
            'payment_method' => 'wallet',
            'trans_type' => config('constants.trans_types.transfer'),
            'status' => config('constants.statuses.completed')
        ]);
      
      	$transaction = Transaction::create([
            'user_id' => $reciever->id,
            'purpose' => "Transfer from $user->full_name",
            'amount' => $request->amount,
            'payment_method' => 'wallet',
            'trans_type' => config('constants.trans_types.transfer'),
            'status' => config('constants.statuses.completed')
        ]);

        Transfer::create([
            'receiver_id' => $reciever->id,
            'sender_id' => $user->id,
            'amount' => $request->amount,
            'status' => config('constants.statuses.completed'),
            'transaction_id' => $transaction->id
        ]);


        // Send Transfer Notification

        Alert::success("Transfer Successful!");

        return back();

    }

    function transferToMainWallet(Request $request) {
        $request->validate([
            'wallet' => 'required|string|in:ref_commission,bonus,cash_back'
        ]);

        $user = $request->user();

        $wallet = $user->wallet;
        $amount = $wallet[$request->wallet];

        $wallet[$request->wallet] -= $amount;
        $wallet->main_balance += $amount;
        $wallet->save();

        Alert::success('Funds transferred to main Balance successfully');

        return back();
    }

}
