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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email_address');
            $table->string('housing_address');
            $table->string('address_key');
            $table->string('miner_name');
            $table->string('miner_city');
            $table->string('miner_status');
            $table->string('miner_scale');
            $table->float('seven_day_reward');
            $table->float('fourteen_day_reward');
            $table->float('thirty_day_reward');
            $table->float('yearly_reward');
            $table->boolean('cash');
            $table->string('account_image')->nullable();
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
        Schema::dropIfExists('accounts');
    }
};
