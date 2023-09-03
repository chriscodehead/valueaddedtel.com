<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService {


    static function create($user, $amount, $method, $status){
        // Transaction::create([
        //     'user_id' => $user->id,
        //     'purpose' => config('constants.transactions.electricity'),
        //     'amount' => $amount,
        //     'payment_method' => $method,
        //     'trans_type' => $trans_type,
        //     'status' => $status
        // ]);
    }

}