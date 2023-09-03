<?php

namespace App\Listeners;

use App\Events\AfterVtuTopUp;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Traits\PaymentTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculateRefAfterTopUp implements ShouldQueue
{
    use PaymentTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AfterVtuTopUp $event)
    {
        $amount = $event->amount;
        $user = $event->user;
        $upline = $user->upline;
        $vtu_ref = GeneralSetting::where('title', 'vtu_ref')->first('value');
        foreach ($upline as $item) {
            if ($item) {
                $refUserPlanLevel = $item->plan->level_commission;
                $position = $item->getPositionOnUpline($user);
                if ($position <= $refUserPlanLevel || $position == 1) {
                    $ref_bonus = $amount * $vtu_ref['value'];
                    $item->wallet->update([
                        'ref_commission' => $item->wallet->ref_commission + $ref_bonus
                    ]);
                    $this->updateTransactionHistory($item->id, config('constants.transactions.referral'), $ref_bonus, config('constants.pay_method.ref'), config('constants.trans_types.deposit'), config('constants.statuses.completed'));
                }
            }
        }
    }
}
