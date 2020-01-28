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
            $table->string('devices__name')->nullable();
            $table->string('i_c_c_i_d')->nullable();
            $table->string('i_m_s_i')->nullable();
            $table->string('r_s_r_p')->nullable();
            $table->string('version__apps')->nullable();
            $table->string('s_s_i_d')->nullable();
            $table->string('user__connection')->nullable();
            $table->string('i_p__address')->nullable();
            $table->string('m_a_c__address')->nullable();
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
