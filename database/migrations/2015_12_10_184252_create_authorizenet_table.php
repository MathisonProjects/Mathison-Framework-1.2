<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizenetTable extends Migration
{
    public function up()
    {
        Schema::create('mfwauthorizenet_credentials', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('api_login_id');
            $table->string('transaction_key');
            $table->boolean('sandbox');
        });
        Schema::create('mfwauthorizenet_paymentprofile', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('owner');
            $table->string('authorize_id_customer');
            $table->string('authorize_id_cc');
            $table->string('last_four');
            $table->integer('cid');
        });
    }

    public function down()
    {
        Schema::drop('mfwauthorizenet_credentials');
        Schema::drop('mfwauthorizenet_paymentprofile');
    }
}
