<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMfwlandingpagesTable extends Migration
{
    public function up()
    {
        Schema::create('mfwlandingpages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('cid');
            $table->binary('landingPage');
        });
    }

    public function down() {
        Schema::drop('mfwlandingpages');
    }
}
