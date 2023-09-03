<?php

namespace Database\Seeders;

use App\Models\LevelCommission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                "name" => "1st",
                "identifier" => 1,
                "referral_comm" => 25,
            ],
            [
                "name" => "2nd",
                "identifier" => 2,
                "referral_comm" => 5,
            ],
            [
                "name" => "3rd",
                "identifier" => 3,
                "referral_comm" => 2.5,
            ],
            [
                "name" => "4th",
                "identifier" => 4,
                "referral_comm" => 1.5,
            ],
            [
                "name" => "5th",
                "identifier" => 5,
                "referral_comm" => 1,
            ],
            [
                "name" => "6th",
                "identifier" => 6,
                "referral_comm" => 1,
            ],
            [
                "name" => "7th",
                "identifier" => 7,
                "referral_comm" => 1,
            ],
            [
                "name" => "8th",
                "identifier" => 8,
                "referral_comm" => 1,
            ],
            [
                "name" => "9th",
                "identifier" => 9,
                "referral_comm" => 1,
            ],
            [
                "name" => "10th",
                "identifier" => 10,
                "referral_comm" => 1,
            ],

        ];
        foreach ($levels as $item) {
            LevelCommission::create($item);
        }
    }
}
