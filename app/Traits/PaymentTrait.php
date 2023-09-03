<?php

namespace App\Traits;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

trait PaymentTrait
{
    use ThirdParty;
    use Generics;

    public function pay_with_flutterwave($plan, $amount, $description, $platform, $callback)
    {
        $email = Auth::guard($platform)->user()->email;
        $phone = Auth::guard($platform)->user()->phone;
        return $this->pay_method_flw($email, $phone, $amount, $description, $callback);
    }

    public function pay_method_flw($email, $phone, $amount, $description, $callback)
    {
        // generate a transaction reference for flutterwave
        $tx_ref = $this->generateId();
        $postDetails = [
            "tx_ref" => $tx_ref,
            "amount" => $amount,
            "currency" => "NGN",
            "redirect_url" => $callback,
            "payment_options" => "card",
            "customer" => [
                "email" => $email,
                "phone_number" => $phone,
                "name" => $description
            ],
            "customizations" => [
                "description" => $description
            ],
        ];
        $url = env("FLW_URL") . "/payments";
        $payment = $this->flutterwavePostEndpoint($url, $postDetails);
        if ($payment['status'] != "success") {
            abort(redirect()->back()->with('errors', $payment['message'] . " please try again later"));
        }
        return $payment;
    }

    public function verify_transaction_flw($request)
    {
        $trans_id = $request->transaction_id;
        $url = env("FLW_URL") . "/transactions/$trans_id/verify";
        $response = $this->flutterwaveGetEndpoint($url);
        return $response;
    }

    public function pay_with_paystack($plan, $amount, $description, $platform, $callback)
    {
        $email = Auth::guard($platform)->user()->email;
        $phone = Auth::guard($platform)->user()->phone;
        return $this->pay_method_paystack($email, $phone, $amount, $description, $callback);
    }

    public function pay_method_paystack($email, $phone, $amount, $description, $callback)
    {
        $paymentDetails = [
            'amount' => $amount * 100, // amount in kobo
            'email' => $email,
            'callback_url' => $callback,
            'metadata' => [
                'custom_fields' => [
                    [
                        'display_name' => "Payment for",
                        'variable_name' => "payment_for",
                        'value' => $description
                    ]
                ]
            ]
        ];
        $url = env("PAYSTACK_URL") . "/transaction/initialize";
        $payment = $this->paystackPostEndpoint($url, $paymentDetails);
        if ($payment['status'] != true) {
            abort(redirect()->back()->with('errors', $payment['message']));
        }
        return $payment;
    }

    public function verify_transaction_paystack($request)
    {
        $reference = $request->reference;
        $url = env("PAYSTACK_URL") . "/transaction/verify/$reference";
        $response = $this->paystackGetEndpoint($url);
        return $response;
    }


    public function pay_for_service($chargedAmount, $purpose, $payment_method, callable $action, $verify_route)
    {
        if ($payment_method == "wallet") {
            $userID = auth('web')->user()->id;
            $wallet = Wallet::where('user_id', $userID)->first();
            
            if ($wallet['main_balance'] < $chargedAmount) {
                return redirect()->back()->with('errors', 'Insufficient wallet Balance');
            }

            //perform action here
            $result = $action();

            $wallet->update([
                'main_balance' => $wallet['main_balance'] - $chargedAmount
            ]);
            

            $this->updateTransactionHistory($userID, $purpose, $chargedAmount, $payment_method, $purpose, config('constants.statuses.completed'));
        }

        if ($payment_method == "paystack") {
            $payment = $this->pay_with_paystack(null, $chargedAmount, config('constants.transactions.payment'), 'web', $verify_route);
            return redirect()->to($payment['data']['authorization_url']);
        }
        return $result;
    }


    public function updateTransactionHistory($userID, $purpose, $chargedAmount, $payment_method, $trans_type, $status)
    {
        $user = User::find($userID);
        Transaction::create([
            'user_id' => $userID,
            'purpose' => $purpose,
            'amount' => $chargedAmount,
            'payment_method' => $payment_method,
            'trans_type' => $trans_type,
            'status' => $status,
            'prev_bal' => $user->wallet->main_balance - $chargedAmount,
            'new_bal' => $user->wallet->main_balance
        ]);
    }
}
