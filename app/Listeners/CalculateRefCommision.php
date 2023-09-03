<?php

namespace App\Listeners;

use App\Events\AfterPlanUpgrade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculateRefCommision implements ShouldQueue
{
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
    public function handle(AfterPlanUpgrade $event)
    {
        $event->user->calculateRefCommission($event->user, $event->amount);
    }
}
