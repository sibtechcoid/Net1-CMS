<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicesNetOnesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DevicesNetOnes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('devices_name')->nullable();
            $table->string('ICCID')->nullable();
            $table->string('IMSI')->nullable();
            $table->string('RSRP')->nullable();
            $table->string('Version_Apps')->nullable();
            $table->string('SSID')->nullable();
            $table->string('User_Connection')->nullable();
            $table->string('IP_Address')->nullable();
            $table->string('MAC_Address')->nullable();
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
        Schema::drop('DevicesNetOnes');
    }
}
