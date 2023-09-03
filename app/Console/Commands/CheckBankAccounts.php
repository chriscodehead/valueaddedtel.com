<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\MonnifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class CheckBankAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::isNotAdmin()->has('bankAccount', '<', 4)->get();;

        $users->map(function($user) {            
            $existingBanks = collect($user->bankAccount()->get('bankCode')->toArray())
                                        ->map(fn($val) => $val['bankCode'])->toArray();

            $missingBanks = collect(config('constants.preferred_banks'))->filter(fn($val) => !in_array($val, $existingBanks))->toArray();
            $monnify = new MonnifyService();
            $monnify->reserve($user, $missingBanks);
        });

    }
}
