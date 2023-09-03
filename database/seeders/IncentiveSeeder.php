<?php

namespace Database\Seeders;

use App\Models\Incentive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncentiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incentives = [
            [
                "name" => "Monthly Leadership Bonus (For VIP and Ambassador Class)",
                "cash_price" => 80000,
                "criteria" => "Generate 10,000PV in a month"
            ],
            [
                "name" => "Local Trip Fund",
                "cash_price" => 500000,
                "criteria" => "Accumulate 25,000PV"
            ],
            [
                "name" => "International Trip Fund",
                "cash_price" => 1500000,
                "criteria" => "Accumulate 60,000PV"
            ],
            [
                "name" => "Car Fund",
                "cash_price" => 3500000,
                "criteria" => "Accumulate 100,000PV"
            ],
            [
                "name" => "House Fund",
                "cash_price" => 5000000,
                "criteria" => "Accumulate 250,000PV"
            ],
            [
                "name" => "SUV Fund",
                "cash_price" => 6000000,
                "criteria" => "Accumulate 500,000PV"
            ],
            [
                "name" => "3 Bedroom Bungalow",
                "cash_price" => 8000000,
                "criteria" => "Accumulate 1,000,000PV"
            ],
            [
                "name" => "Products",
                "cash_price" => "Product Sharing",
                "criteria" => "Accumulate 2,000,000PV"
            ],
        ];

        foreach ($incentives as $item) {
            Incentive::create($item);
        }
    }
}
