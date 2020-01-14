<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_name')->nullable();
            $table->string('banner_picture')->nullable();
            $table->string('banner_uri')->nullable();
            $table->tinyInteger('banner_order')->nullable();
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
        Schema::drop('Banners');
    }
}
