<?php

namespace Database\Seeders;

use App\Models\ElectricityCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectricitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $companies = [
            [
                'service_id' => 'ikeja-electric',
                'name' => 'Ikeja Electricity Distribution Company (IKEDC)',
            ],
            [
                'service_id' => 'eko-electric',
                'name' => 'Eko Electricity Distribution Company (EKEDC)',
            ],
            [
                'service_id' => 'kano-electric',
                'name' => 'Kano Electricity Distribution Company (KEDCO)',
            ],
            [
                'service_id' => 'portharcourt-electric',
                'name' => 'Port Harcourt Electricity Distribution Company (PHED)',
            ],
            [
                'service_id' => 'jos-electric',
                'name' => 'Jos Electricity Distribution Company (JED)',
            ],
            [
                'service_id' => 'ibadan-electric',
                'name' => 'Ibadan Electricity Distribution Company (IBEDC)',
            ],
            [
                'service_id' => 'kaduna-electric',
                'name' => 'Kaduna Electricity Distribution Company (KAEDCO)',
            ],
            [
                'service_id' => 'abuja-electric',
                'name' => 'Abuja Electricity Distribution Company (AEDC)',
            ],
            [
                'service_id' => 'enugu-electric',
                'name' => 'Enugu Electricity Distribution Company (EEDC)',
            ],
            [
                'service_id' => 'benin-electric',
                'name' => 'Benin Electricity Distribution Company (BEDC)',
            ],
        ];

        foreach ($companies as $key => $value) {
            ElectricityCompany::create($value);
        }
    }
}
