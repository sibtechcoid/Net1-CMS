<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productlistmobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //productlist mobile 

        Schema::create('ProductlistMobile', function (Blueprint $table) {
            $table->bigIncrements('id_productlist');
            $table->string('offerIDM', 100);
            $table->string('Product_published_name', 100);
            $table->string('description', 100);
            $table->string('chargingType', 100);
            $table->string('offerType', 100);
            $table->string('serviceZone', 100);
            $table->bigInteger('totalPrice');
            $table->dateTime('validity_date'); // waktu 
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
