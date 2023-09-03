<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentService {

    function wallet($user, $amount){
        $wallet = $user->wallet;

        if ($wallet['main_balance'] < $amount) {
            Alert::error('Insufficient wallet Balance');
            return abort(back());
        }

        $wallet->main_balance -= $amount;
        $wallet->save();
    }

    function paystack(){

    }

    function save($user, $company, $amount, $payment){

    }


}