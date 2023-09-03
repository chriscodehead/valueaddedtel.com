<?php

namespace Database\Seeders;

use App\Models\Network;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $networks = [
            [
                "name" => 'MTN',
                "legit_plan_id" => "1",
                'vtpass_airtime_id' => "mtn"
            ],
            [
                "name" => 'GLO',
                "legit_plan_id" => "3",
                'vtpass_airtime_id' => "glo"
            ],
            [
                "name" => 'AIRTEL',
                "legit_plan_id" => "2",
                'vtpass_airtime_id' => "airtel"
            ],
            [
                "name" => '9MOBILE',
                "legit_plan_id" => "4",
                'vtpass_airtime_id' => "etisalat"
            ],
        ];
        foreach ($networks as $item) {
            Network::create($item);
        }
    }
}
