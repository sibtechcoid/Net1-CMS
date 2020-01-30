<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRewadNetOnesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RewadNetOnes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_rewads')->nullable();
            $table->date('validity_date')->nullable();
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
        Schema::drop('RewadNetOnes');
    }
}
