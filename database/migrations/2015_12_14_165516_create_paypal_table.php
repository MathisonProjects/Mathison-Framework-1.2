<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizenetTable extends Migration
{
    public function up()
    {
        Schema::create('mfwapaypal_credentials', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('client_id');
            $table->string('client_secret');
            $table->boolean('sandbox');
        });
        Schema::create('mfwapaypal_paymentprofile', function(Blueprint $table)
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
        Schema::drop('mfwapaypal_credentials');
        Schema::drop('mfwapaypal_paymentprofile');
    }
}
