<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if(Settings::all()->isEmpty()){
            Settings::create([
                'monnify_charge' => 50, 
                'bank_name' => 'First bank', 
                'account_no' => '2033705394', 
                'account_name' => 'Xtrarvalue Added International Ltd'
            ]);
        }
    }
}
