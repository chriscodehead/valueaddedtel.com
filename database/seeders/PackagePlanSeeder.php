<?php

namespace Database\Seeders;

use App\Models\PackagePlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackagePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                "package_name" => "Free Account",
                "reg_fee" => 0,
                "reg_bonus" => 0,
                "level_commission" => 0,
                "point_value" => 0,
            ],
            [
                "package_name" => "O level Class",
                "reg_fee" => 1000,
                "reg_bonus" => 150,
                "level_commission" => 1,
                "point_value" => 2,
            ],
            [
                "package_name" => "Pre Degree Class	",
                "reg_fee" => 2500,
                "reg_bonus" => 375,
                "level_commission" => 2,
                "point_value" => 5,
            ],
            [
                "package_name" => "Pass Class",
                "reg_fee" => 5000,
                "reg_bonus" => 750,
                "level_commission" => 4,
                "point_value" => 10,
            ],
            [
                "package_name" => "3rd Class",
                "reg_fee" => 10000,
                "reg_bonus" => 1500,
                "level_commission" => 5,
                "point_value" => 20,
            ],
            [
                "package_name" => "2nd Class",
                "reg_fee" => 20000,
                "reg_bonus" => 3000,
                "level_commission" => 6,
                "point_value" => 40,
            ],
            [
                "package_name" => "1st Class",
                "reg_fee" => 30000,
                "reg_bonus" => 4500,
                "level_commission" => 7,
                "point_value" => 60,
            ],
            [
                "package_name" => "Business Class",
                "reg_fee" => 40000,
                "reg_bonus" => 6000,
                "level_commission" => 8,
                "point_value" => 80,
            ],
            [
                "package_name" => "VIP Class",
                "reg_fee" => 50000,
                "reg_bonus" => 7500,
                "level_commission" => 10,
                "point_value" => 100,
            ],
            [
                "package_name" => "Ambassador Class",
                "reg_fee" => 100000,
                "reg_bonus" => 15500,
                "level_commission" => 10,
                "point_value" => 200,
            ],

        ];
        foreach ($plans as $item) {
            PackagePlan::create($item);
        }
    }
}
