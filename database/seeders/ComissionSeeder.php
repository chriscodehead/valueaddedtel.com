<?php

namespace Database\Seeders;

use App\Models\Comission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comissions = [
            [
                'service' => 'education',
                'comission' => 40,
                'type' => 'fixed',
                'wallet' => 'cash'
            ],

            [
                'service' => 'electricity',
                'comission' => 1,
                'type' => 'percent',
                'wallet' => 'cash'
            ]
        ];
        foreach ($comissions as $key => $value) {
            Comission::create($value);
        }
    }
}
