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
        Schema::create('recharge_cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('network');
            $table->string('user_id');
            $table->string('transactionid');
            $table->string('reference');
            $table->integer('denomination');
            $table->integer('quantity');
            $table->text('data');
            $table->integer('amount');
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
        Schema::dropIfExists('recharge_cards');
    }
};
