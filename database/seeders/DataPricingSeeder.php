<?php

namespace Database\Seeders;

use App\Models\DataPrincing;
use App\Models\Network;
use App\Traits\ThirdParty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPricingSeeder extends Seeder
{
    use ThirdParty;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //The 3 types of plans are SME, GIFTING and COOPERATE GIFTING
        $mtn = Network::where('name', 'MTN')->first();
        $glo = Network::where('name', 'GLO')->first();
        $airtel = Network::where('name', 'AIRTEL')->first();
        $etisalat = Network::where('name', '9MOBILE')->first();
        $prices = [
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "36",
                'plan_type' => "SME",
                'plan_name' => "500MB",
                'amount' => "140",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "37",
                'plan_type' => "SME",
                'plan_name' => "1GB",
                'amount' => "240",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "38",
                'plan_type' => "SME",
                'plan_name' => "2GB",
                'amount' => "480",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "39",
                'plan_type' => "SME",
                'plan_name' => "3GB",
                'amount' => "780",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "40",
                'plan_type' => "SME",
                'plan_name' => "5GB",
                'amount' => "1200",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "41",
                'plan_type' => "SME",
                'plan_name' => "10GB",
                'amount' => "2400",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "43",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "50MB",
                'amount' => "50",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "44",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "150MB",
                'amount' => "105",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "45",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "250MB",
                'amount' => "125",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "42",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "500MB",
                'amount' => "145",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "46",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "1GB",
                'amount' => "250",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "47",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "2GB",
                'amount' => "500",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "48",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "3GB",
                'amount' => "800",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "49",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "5GB",
                'amount' => "1250",
                'period' => "30days"
            ],
            [
                'network_id' => $mtn->legit_plan_id,
                'network' => "MTN",
                'api_plan_id' => "50",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "10GB",
                'amount' => "2450",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "56",
                'plan_type' => "GIFTING",
                'plan_name' => "1.5GB",
                'amount' => "500",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "57",
                'plan_type' => "GIFTING",
                'plan_name' => "2.9GB",
                'amount' => "1000",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "58",
                'plan_type' => "GIFTING",
                'plan_name' => "4.1GB",
                'amount' => "1350",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "59",
                'plan_type' => "GIFTING",
                'plan_name' => "5.8GB",
                'amount' => "2000",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "60",
                'plan_type' => "GIFTING",
                'plan_name' => "10GB",
                'amount' => "3150",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "200MB",
                'amount' => "100",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "71",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "500MB",
                'amount' => "170",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "72",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "1GB",
                'amount' => "240",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "73",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "2GB",
                'amount' => "480",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "74",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "3GB",
                'amount' => "720",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "75",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "5GB",
                'amount' => "1200",
                'period' => "30days"
            ],
            [
                'network_id' => $glo->legit_plan_id,
                'network' => "GLO",
                'api_plan_id' => "76",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "10GB",
                'amount' => "2300",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "67",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "100MB",
                'amount' => "60",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "66",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "300MB",
                'amount' => "120",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "51",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "500MB",
                'amount' => "160",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "52",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "1GB",
                'amount' => "240",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "53",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "2GB",
                'amount' => "480",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "54",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "5GB",
                'amount' => "1200",
                'period' => "30days"
            ],
            [
                'network_id' => $airtel->legit_plan_id,
                'network' => "AIRTEL",
                'api_plan_id' => "55",
                'plan_type' => "COOPERATE GIFTING",
                'plan_name' => "10GB",
                'amount' => "2240",
                'period' => "30days"
            ],
            [
                'network_id' => $etisalat->legit_plan_id,
                'network' => "9MOBILE",
                'api_plan_id' => "69",
                'plan_type' => "GIFTING",
                'plan_name' => "500MB",
                'amount' => "500",
                'period' => "30days"
            ],
            [
                'network_id' => $etisalat->legit_plan_id,
                'network' => "9MOBILE",
                'api_plan_id' => "70",
                'plan_type' => "GIFTING",
                'plan_name' => "1.5GB",
                'amount' => "950",
                'period' => "30days"
            ],
        ];

        $plans = $this->get_all_plans();
        $data = $plans['data']['plans'];
        foreach ($data as $item) {
            DataPrincing::create([
                'network' => $item['network'],
                'api_plan_id' => $item['id'],
                'plan_type' => $item['type'],
                'plan_name' => $item['plan'],
                'amount' => $item['amount'],
                'period' => "30days"
            ]);
        }
    }
}
