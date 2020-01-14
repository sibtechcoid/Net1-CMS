<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_customer_segment')->nullable();
            $table->string('residence_type')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('account_name')->nullable();
            $table->string('customer_cis_to_category')->nullable();
            // $table->string('customer_cis_to_category')->nullable();
            $table->string('customer_identity_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('kk_number')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('device_id')->nullable();
            $table->string('preferred_language')->nullable();
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
        Schema::drop('Customers');
    }
}
