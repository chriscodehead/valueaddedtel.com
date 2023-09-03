<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->float('main_balance', 10, 2)->default(0);
            $table->float('ref_commission', 10, 2)->default(0);
            $table->bigInteger('points')->default(0);
            $table->float('bonus', 10, 2)->default(0);
            $table->float('charge_back', 10, 2)->default(0);
            $table->float('cash_back', 10, 2)->default(0);
            $table->float('withdrawals', 10, 2)->default(0);
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
        Schema::dropIfExists('wallets');
    }
};
