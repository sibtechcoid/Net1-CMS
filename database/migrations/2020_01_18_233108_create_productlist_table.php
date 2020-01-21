<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productlist', function (Blueprint $table) {
            $table->bigIncrements('id_productlist');
            $table->string('offerID', 100);
            $table->string('offerName', 100);
            $table->string('description', 100);
            $table->string('chargingType', 100);
            $table->string('offerType', 100);
            $table->string('serviceZone', 100);
            $table->bigInteger('totalPrice');
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
        Schema::dropIfExists('productlist');
    }
}
