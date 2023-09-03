<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PackagePlanSeeder::class);
        $this->call(LevelCommissionSeeder::class);
        $this->call(IncentiveSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NetworkSeeder::class);
        $this->call(DataPricingSeeder::class);
        $this->call(AirtimeNetworkSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(ElectricitySeeder::class);
        $this->call(SettingSeeder::class);
        // $this->call(RechargeCardSeeder::class);
    }
}
