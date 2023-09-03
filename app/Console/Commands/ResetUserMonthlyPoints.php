<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;

class ResetUserMonthlyPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Reset the User's Point Value";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Wallet::where('monthly_pv', '>', 0)->update(['monthly_pv' => 0]);
    }
}
