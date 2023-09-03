<?php

namespace Database\Seeders;

use App\Models\RechargeCard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RechargeCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RechargeCard::create($this->arr(1, 'MTN', 100, 98.00));
        RechargeCard::create($this->arr(2, 'MTN', 200, 198.00));
        RechargeCard::create($this->arr(3, 'MTN', 500, 495.00));
        RechargeCard::create($this->arr(4, 'GLO', 100, 98.00));
        RechargeCard::create($this->arr(5, 'GLO', 200, 198.00));
        RechargeCard::create($this->arr(6, 'GLO', 500, 490.00));
        RechargeCard::create($this->arr(7, 'AIRTEL', 100, 98.00));
        RechargeCard::create($this->arr(8, 'AIRTEL', 200, 196.00));
        RechargeCard::create($this->arr(9, 'AIRTEL', 500, 490.00));
    }

    function arr($planId, $network, $name, $amount){
        return [
            'planId' => $planId,
            'network' => $network,
            'name' => $name,
            'load_pin' => '*311*pin#',
            'check_balance' => "*310#",
            'amount' => $amount
        ];
    }
}
