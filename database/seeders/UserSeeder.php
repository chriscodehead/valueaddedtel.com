<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\PackagePlan;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use Generics;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultPlan = PackagePlan::first();

        $user = User::create([
            'username' => "ceoxtrarvalueadded",
            'firstname' => "Godswill",
            'lastname' => "Anuhwin",
            'email' => "ceoxtrarvalueadded@yahoo.com",
            'phone' => "08037610045",
            'password' => Hash::make("Xtravalue@2023"),
            'role' => Roles::SUPERADMIN->value,
            'isVerified' => "1",
            'email_verified_at' => Carbon::now(),
            'my_ref_code' => $this->createUniqueRand('users', 'my_ref_code'),
            'plan_id' => $defaultPlan['id'],
            'no_of_referrals' => "0",
            'status' => true
        ]);

        Wallet::create([
            'user_id' => $user->id
        ]);
    }
}
