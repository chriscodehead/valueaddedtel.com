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
        Schema::create('package_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('package_name')->nullable();
            $table->float('reg_fee', 10, 2)->default(0);
            $table->float('reg_bonus', 10, 2)->default(0);
            $table->integer('level_commission')->default(0);
            $table->integer('point_value')->default(0);
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
        Schema::dropIfExists('package_plans');
    }
};
