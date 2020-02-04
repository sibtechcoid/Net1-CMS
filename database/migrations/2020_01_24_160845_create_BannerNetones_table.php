<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannerNetonesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BannerNetones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_name')->nullable();
            $table->string('banner_picture')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('banner_order')->nullable();
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
        Schema::drop('BannerNetones');
    }
}
