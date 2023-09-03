<?php

namespace Database\Seeders;

use App\Models\AirtimeNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirtimeNetworkSeeder extends Seeder
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
                "name" => 'MTN VTU',
                "network_id" => "15"
            ],
            [
                "name" => 'MTN AWUFU',
                "network_id" => "20"
            ],
            [
                "name" => 'GLO',
                "network_id" => "6"
            ],
            [
                "name" => 'Airtel',
                "network_id" => "1"
            ],
            [
                "name" => '9Mobile',
                "network_id" => "2"
            ],
        ];
        foreach ($networks as $item) {
            AirtimeNetwork::create($item);
        }
    }
}
