<?php

use App\Enums\Roles;
use App\Models\PackagePlan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->string('password');
            $table->string('pin')->nullable();
            $table->string('role')->default(Roles::USER->value);
            $table->string('refer_by')->nullable();
            $table->string('my_ref_code')->unique();
            $table->string('account_number')->unique()->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('no_of_referrals')->default(0);
            $table->foreignUuid('plan_id')->nullable();
            $table->bigInteger('no_of_upgrades')->default(0);
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
