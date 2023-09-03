<?php

namespace App\Traits;

use App\Models\Bank;
use App\Models\EmailVerifyToken;
use App\Models\PackagePlan;
use App\Models\PasswordReset;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VtuHistory;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\PasswordResetNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

trait Generics
{
    use ThirdParty;


    //send email verification code
    public function send_verify_email($email, $name)
    {
        $code = $this->createUniqueRand('email_verify_tokens', 'code');
        $user = User::where('email', $email)->first();

        EmailVerifyToken::create([
            'code' => $code,
            'email' => $email,
            'expires_at' => Carbon::now()->addMinutes(30)->toDateTimeString()
        ]);

        Notification::send($user, new VerifyEmailNotification($name, $email, $code));
    }


    //send password reset code
    public function send_reset_code($email)
    {
        $code = $this->createUniqueRand('password_resets', 'code');
        $user = User::where('email', $email)->first();
        PasswordReset::create([
            'code' => $code,
            'email' => $email,
            'expires_at' => Carbon::now()->addMinutes(30)->toDateTimeString()
        ]);
        $user->notify(new PasswordResetNotification($user['name'], $code));
    }

    // a function that generates a random unique ID
    function generateId()
    {
        $unique_id = (string) Str::uuid();
        $exploded = explode('-', $unique_id);
        $n_unique_id = $exploded[4];
        return $n_unique_id;
    }

    // a function that generates random letters
    function randomLetters($len)
    {
        $str = '';
        $a = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $b = str_split($a);
        for ($i = 1; $i <= $len; $i++) {
            $str .= $b[rand(0, strlen($a) - 1)];
        }
        return $str;
    }


    // a function that generates unique random id with reference to a specific table
    function createUniqueID($table, $column)
    {
        $unique_id = (string) Str::uuid();
        $exploded = explode('-', $unique_id);
        $id = $exploded[4];
        return DB::table($table)->where($column, $id)->first() ? $this->createUniqueID($table, $column) :  $id;
    }


    // a function that generates unique random numbers with reference to a specific table
    function createUniqueRand($table, $column)
    {
        $id = rand(1000000, 9909999);
        return DB::table($table)->where($column, $id)->first() ? $this->createUniqueRand($table, $column) :  $id;
    }


    // a function that returns all authenticated pages with their values
    function dynamicPage($page)
    {
        $userID = auth('web')->user()->id;
        $user = User::where('id', $userID)->first();
        
        $settings = Settings::first();
        $wallet_transactions = Transaction::where('user_id', $userID)->where('purpose', config('constants.transactions.wallet_top'))->orWhere('trans_type', config('constants.trans_types.withdraw'))->where('user_id', $userID)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'transactions');
        $transactions = Transaction::where('user_id', $userID)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'transactions');
        $allBanks = Bank::all();
        $histories = VtuHistory::where('user_id', $userID)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'histories');
        $allPlans = PackagePlan::all();

        $collection = [ 'transactions', 'wallet_transactions', 'histories', 'allPlans', 'allBanks', 'settings', 'user'];

        return view($page)->with(compact($collection));
    }


    // a function that checks for wallet sufficiency
    function checkWalletSufficiency($platform, $amount)
    {
        //get user information to check wallet balance
        $user = User::where('id', auth($platform)->user()->id)->first();
        $wallet_balance = $user['wallet_balance'];
        if ($amount > $wallet_balance) {
            return false;
        } else {
            return true;
        }
    }


    // a function that add funds to wallet
    function addFundsToUserWallet($user_id, $amount)
    {
        $user = User::where('id', $user_id)->first();
        $existing_amount = $user['wallet_balance'];

        $user->update([
            'wallet_balance' => $existing_amount + $amount
        ]);
    }


    //a function that deducts funds from wallet
    function deductWalletBalance($user_id, $amount)
    {
        $user = User::where('id', $user_id)->first();
        $user->update([
            'wallet_balance' => $user['wallet_balance'] - $amount
        ]);
    }


    // a function that generates a special request ID for vtpass third party services
    function generateRequestID()
    {
        $dateTime = explode(' ', Carbon::now('Europe/London'));
        $afterExp = $dateTime[0] . $dateTime[1];
        $finalDate = preg_replace('/-|:/', '', $afterExp);
        $requestID = $finalDate . $this->randomLetters(5);
        return $requestID;
    }


    // get amount from a specified verification code
    function deduceAmountFromVariationCode($variation_code)
    {
        $exp_variation = explode("/", $variation_code);
        $name = $exp_variation[0];
        $amount = $exp_variation[1];
        $code = $exp_variation[2];

        $deduced = ([
            'plan' => $name,
            'amount' => $amount,
            'code' => $code
        ]);
        return $deduced;
    }

    //a function that returns useful disco states for buypower service
    function discoStates()
    {
        $data = [
            'ABUJA',
            'EKO',
            'IKEJA',
            'IBADAN',
            'ENUGU',
            'PH',
            'JOS',
            'KADUNA',
            'KANO',
            'BH'
        ];

        return $data;
    }
}
