<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer ".env('PAYSTACK_TEST_SK')
        ])->get('https://api.paystack.co/bank', ['country' => 'nigeria']);

        if ($response->ok()) {
            $banks = $response->collect();

            $data = array_map(function($bank){
                return [
                    'bank_name' => $bank['name'],
                    'bank_code' => $bank['code'],
                ];
            }, $banks->toArray()['data']);

            Bank::insert($data);
        }
    }
}
