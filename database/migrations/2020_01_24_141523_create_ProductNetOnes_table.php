<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductNetOnesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductNetOnes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('offer_id')->nullable();
            $table->string('offer_name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('charging_type')->nullable();
            $table->string('offer_type')->nullable();
            $table->string('service_zone')->nullable();
            $table->decimal('total_price')->nullable();
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
        Schema::drop('ProductNetOnes');
    }
}
