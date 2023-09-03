<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "title" => 'airtime_charge',
                "value" => '0',
                'type' => 'percent'
            ],
            [
                "title" => 'airtime_cash_back',
                "value" => '0.02',
                'type' => 'percent'
                
            ],
          [
                "title" => 'airtime_cash_back_referrer',
                "value" => '0.01',
                'type' => 'percent'
                
            ],
            [
                "title" => 'data_charge',
                "value" => '0',
                'type' => 'percent'
            ],
            [
                "title" => 'data_cash_back',
                "value" => '0.02',
                'type' => 'percent'
            ],
          	[
                "title" => 'data_cash_back_referrer',
                "value" => '0.01',
                'type' => 'percent'
            ],
            [
                "title" => 'cable_cashback',
                "value" => 40,
                'type' => 'fixed'
            ],
            [
                "title" => 'cable_charge',
                "value" => '0',
                'type' => 'percent'
            ],
            [
                "title" => 'vtu_ref',
                "value" => '0.001',
                'type' => 'percent'
            ],
            [
                "title" => 'electricity',
                "value" => 0.01,
                'type' => 'percent'
            ],
            [
                "title" => 'education',
                "value" => 40,
                'type' => 'fixed'
            ],
            [
                "title" => 'recharge_card_cashback',
                "value" => 0.1,
                'type' => 'percent'
            ],
        ];

        foreach ($data as $item) {
            GeneralSetting::create($item);
        }
    }
}
