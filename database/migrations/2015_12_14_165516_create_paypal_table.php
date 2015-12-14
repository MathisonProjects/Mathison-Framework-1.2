<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalTable extends Migration
{
    public function up()
    {
        Schema::create('mfwpaypal_credentials', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('client_id');
            $table->string('client_secret');
            $table->boolean('sandbox');
        });
        Schema::create('mfwpaypal_paymentprofile', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('owner');
            $table->string('payment_id');
            $table->string('last_four');
            $table->integer('cid');
        });
    }

    public function down()
    {
        Schema::drop('mfwpaypal_credentials');
        Schema::drop('mfwpaypal_paymentprofile');
    }
}
