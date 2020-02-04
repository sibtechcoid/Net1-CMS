<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRewardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rewards', function (Blueprint $table) {
            $table->increments('id_reward');
            $table->bigInteger('msisdn')->nullable();
            $table->integer('point_reward')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('last_update')->nullable();
            $table->string('user')->nullable();
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
        Schema::drop('Rewards');
    }
}
