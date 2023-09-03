<?php

namespace App\Http\Controllers\frontend;

use App\Events\AfterPlanUpgrade;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletTopUpRequest;
use App\Models\LevelCommission;
use App\Models\PackagePlan;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VtuHistory;
use App\Models\Wallet;
use App\Services\ReferralService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\Responses;
use App\Traits\ThirdParty;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Date;

class PaymentController extends Controller
{
    use Generics;
    use Responses;
    use PaymentTrait;

    function reciept($type, $id) {
        $models = [
            'transaction' => Transaction::class,
            'vtu_history' => VtuHistory::class
        ];

        $transaction  = $models[$type]::find($id);
      
      	if($transaction->service == config("constants.services.electricity")){          
          	$transaction['electricity'] = $transaction->electricity;
        }
        $pdf = Pdf::loadView('receipt', [
            'name' => $transaction->user->full_name,
            'amount' =>  $transaction['amount'],
            'status' => $transaction['status'],
          	'electricity' => $transaction['electricity'],
            'narration' => $type === 'transaction' ? $transaction['purpose'] : $transaction['service'],
            'reference' => $transaction['id'],
            'paymentMethod' => $transaction['payment_method'],
            'phone' => $transaction['phone'] ?? null,
            'type' => $transaction['trans_type'] ?? $transaction['vtu_plan'] ?? $transaction['purpose'] ?? $transaction['service'],
            'date' => Date::parse($transaction['created_at'])->format('jS F, Y h:m A'),
          	'network' => $transaction['network'] ?? '' 
        ]);

        return $pdf->download($id.'-reciept.pdf');
    }

    public function initiateTopUp(WalletTopUpRequest $request)
    {
        $data = $this->validatingRequest($request);
        session(['pay_service' => $data['pay_service']]);

        if ($data['pay_service'] == "flw") {
            $payment = $this->pay_with_flutterwave($data, $data['amount'], config('constants.transactions.wallet_top'), 'web', route('verify-top-up'));
            return redirect()->to($payment['data']['link']);
        } elseif ($data['pay_service'] == 'paystack') {
            $payment = $this->pay_with_paystack($data, $data['amount'], config('constants.transactions.wallet_top'), 'web', route('verify-top-up'));
            return redirect()->to($payment['data']['authorization_url']);
        }
    }

    public function verifyTopUp(Request $request)
    {
        if (session('pay_service') == "flw") {
            if ($request->status == "cancelled") {
                return redirect()->route('dashboard')->with('errors', "Transaction was Cancelled");
            }
            $result = $this->verify_transaction_flw($request);
            if ($result['status'] != "success") {
                return redirect()->back()->with('errors', 'Payment was not successfull');
            }
            $amount = $result['data']['amount'];
            $pay_service = config('constants.pay_method.flw');
        } elseif (session('pay_service') == "paystack") {
            $result = $this->verify_transaction_paystack($request);
            if ($result['status'] != true) {
                return redirect()->back()->with('errors', 'Payment was not successfull');
            }
            $amount = $result['data']['amount'] / 100;
            $pay_service = config('constants.pay_method.paystack');
        }

        $wallet = Wallet::where('user_id', auth('web')->user()->id)->first();
        $wallet->update(['main_balance' => $wallet['main_balance'] + $amount]);

        $this->updateTransactionHistory(auth('web')->user()->id, config('constants.transactions.wallet_top'), $amount, $pay_service, config('constants.trans_types.deposit'), config('constants.statuses.completed'));
        return redirect()->route('dashboard')->with('success', "NGN $amount has been added to your wallet successfully");
    }

    public function purchasePlanFlw(PackagePlan $plan)
    {
        $user = auth()->user();
        if (!$plan) {
            return redirect()->back()->with('errors', 'Plan does not exist');
        }
        session(['plan_id' => $plan->id]);
        if($plan->level_commission <= $user->plan->level_commission) return back()->with('errors', "You can only upgrade to a plan greater than your current plan!");
        $payment = $this->pay_with_flutterwave($plan, $plan->reg_fee, config('constants.transactions.plan_upgrade'), 'web', route('verify-plan-purchase-flw'));
        return redirect()->to($payment['data']['link']);
    }

    public function confirmPurchaseFlw(Request $request)
    {
        if ($request->status == "cancelled") {
            return redirect()->route('dashboard')->with('errors', "Transaction was Cancelled");
        }
        $result = $this->verify_transaction_flw($request);
        if ($result['status'] != "success") {
            return redirect()->back()->with('errors', 'Payment was not successfull');
        }
        return $this->updateUserPlan($result['data']['amount'], config('constants.pay_method.flw'), session('plan_id'));
    }

    public function purchasePlanPaystack(PackagePlan $plan)
    {
        if (!$plan) {
            return redirect()->back()->with('errors', 'Plan does not exist');
        }

        
        $user = auth()->user();
        if($plan->level_commission <= $user->plan->level_commission) return back()->with('errors', "You can only upgrade to a plan greater than your current plan!");
        $fee = $plan->reg_fee - $user->plan->reg_fee;

        session(['plan_id' => $plan->id]);

        $payment = $this->pay_with_paystack($plan, $fee, config('constants.transactions.plan_upgrade'), 'web', route('verify-plan-purchase-paystack'));
        return redirect()->to($payment['data']['authorization_url']);
    }


    public function confirmPurchasePaystack(Request $request)
    {
        $result = $this->verify_transaction_paystack($request);
        if ($result['status'] != true) {
            return redirect()->back()->with('errors', 'Payment was not successfull');
        }
        $amount = $result['data']['amount'] / 100;
        return $this->updateUserPlan($amount, config('constants.pay_method.paystack'), session('plan_id'));
    }


    public function purchasePlanWallet(Request $request)
    {
        $user = auth()->user();
        $plan = PackagePlan::find($request->id);
        if (!$plan) {
            return redirect()->back()->with('errors', 'Plan does not exist');
        }
        
        $fee = $plan->reg_fee - $user->plan->reg_fee;
      	$percentageDiff = ($user->plan->reg_fee / $plan->reg_fee) * 100; 

        if($plan->level_commission <= $user->plan->level_commission) return back()->with('errors', "You can only upgrade to a plan greater than your current plan!");
        $wallet = Wallet::where('user_id', auth('web')->user()->id)->first();
        if ($wallet['main_balance'] < $fee) {
            return redirect()->back()->with('errors', 'Insufficient wallet Balance');
        }

        return $this->updateUserPlan($fee, config('constants.pay_method.wallet'), $plan->id, $percentageDiff);
    }

    private function updateUserPlan($amount, $payment_method, $plan_id, $percentageDiff)
    {
        $user = User::find(auth('web')->user()->id);
        $user->update(['plan_id' => $plan_id, 'no_of_upgrades' => $user['no_of_upgrades'] + 1]);

        $plan = PackagePlan::find($plan_id);

        $wallet = Wallet::where('user_id', auth('web')->user()->id)->first();

        $wallet->bonus += $percentageDiff > 0 ? ($percentageDiff / 100) * $plan->reg_bonus : $plan->reg_bonus;
        $wallet->points += $plan->point_value;
        $wallet->monthly_pv += $plan->point_value;
        $wallet->save();
        
        if ($user['refer_by'] !== null && $user['refer_by'] !== '') ReferralService::handlePayout($user, $amount);

        $this->updateTransactionHistory(auth('web')->user()->id, config('constants.transactions.plan_upgrade'), $amount, $payment_method, config('constants.trans_types.plan_upgrade'), config('constants.statuses.completed'));
        $this->updateTransactionHistory(auth('web')->user()->id, config('constants.transactions.reg_bonus'), $plan['reg_bonus'], $payment_method, config('constants.trans_types.reg_bonus'), config('constants.statuses.completed'));

        if ($payment_method == config('constants.pay_method.wallet')) {
            $user->wallet->update(['main_balance' => $user->wallet->main_balance - $amount]);

            $this->updateTransactionHistory(auth('web')->user()->id, config('constants.transactions.wallet_remove'), $plan['reg_fee'], $payment_method, config('constants.trans_types.plan_upgrade_withdrawal'), config('constants.statuses.completed'));
        }

        return redirect()->route('dashboard')->with('success', "Congratulations on your Upgrade to the $plan->package_name");
    }
}
