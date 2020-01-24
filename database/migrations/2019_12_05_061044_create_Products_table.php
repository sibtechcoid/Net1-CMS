<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('offer_id', 100);
            $table->string('offer_name', 100);
            $table->string('display_name', 100);//for mobile
            $table->string('description', 100);
            $table->string('charging_type', 100);
            $table->string('offer_type', 100);
            $table->string('service_zone', 100);
            $table->bigInteger('total_price');
            $table->dateTime('validity_date');//time for expire mobile user
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
        Schema::drop('Products');
    }
}
