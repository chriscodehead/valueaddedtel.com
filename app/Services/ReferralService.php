<?php

namespace App\Services;

use App\Models\LevelCommission;
use App\Models\PackagePlan;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\PaymentTrait;

class ReferralService {
    use PaymentTrait;

    static function handlePayout($user, $amount){
        if(!$user->referrer) return;
        $levels = LevelCommission::all();
        $user->refresh();
        
        self::payout($user->referrer, $amount, $user->plan->point_value, $levels);
    }

    static function pay($referrer, $amount, $levels){
        static $level = 1;

        $refUserPlanLevel = $referrer->plan->level_commission;
        
        if(static::checkUserLevel($level, $refUserPlanLevel))  {
            $wallet = $referrer->wallet;
            $wallet->cash_back += $amount;
            $wallet->save();

            $wallet->refresh();

            Transaction::create([
                'user_id' => $referrer->id,
                'purpose' => str("Referral Cashback")->headline(),
                'amount' => $amount,
                'payment_method' => 'cashback',
                'trans_type' => config('constants.trans_types.referral_cashback'),
                'status' => 'success',
                'prev_bal' => $wallet->main_balance - $amount,
                'new_bal' => $wallet->main_balance
            ]);
        }

        ++$level;

        if($level > $levels->count()) return;
      	if(!$referrer->referrer) return;
        return static::pay($referrer->referrer, $amount, $levels);
    }

    private static function payout($referrer, $amount, $pv, $levels) {
        static $level = 1;

        $comissionValue = $levels->where('identifier', $level)->first()->referral_comm;
        $commission = floor(($amount * $comissionValue) / 100);

        $refUserPlanLevel = $referrer->plan->level_commission;

        if(static::checkUserLevel($level, $refUserPlanLevel)) static::updateWallet($referrer, $commission, $pv);
        ++$level;
        
        if(!$referrer->referrer) return;
        if($level > $levels->count()) return;
        return static::payout($referrer->referrer, $amount, $pv, $levels);
    }

    static function checkUserLevel($currLevel, $userLevel){
        return $currLevel <= $userLevel;
    }

    static function saveTransactions($transaction, $pvTransaction){
        Transaction::create($transaction);
        Transaction::create($pvTransaction);
    }

    static function updateWallet($referrer, $comission, $pv = null){
        $wallet = $referrer->wallet;
        $wallet->ref_commission += $comission;

        if($pv){
            $wallet->points += $pv;
            $wallet->monthly_pv += $pv;
        }

        $wallet->save();

        $transaction = [
            'user_id' => $referrer->id,
            'purpose' => config('constants.transactions.referral'),
            'amount' => $comission,
            'payment_method' => config('constants.pay_method.ref'),
            'trans_type' => config('constants.trans_types.referral'),
            'status' => config('constants.statuses.completed')
        ];

        Transaction::create($transaction);

        if($pv){
            $pvTransaction = [
                'user_id' => $referrer->id,
                'purpose' => "PV",
                'amount' => $pv,
                'payment_method' => config('constants.pay_method.ref'),
                'trans_type' => config('constants.trans_types.pv'),
                'status' => config('constants.statuses.completed')
            ];

            Transaction::create($pvTransaction);
        }
    }




}
