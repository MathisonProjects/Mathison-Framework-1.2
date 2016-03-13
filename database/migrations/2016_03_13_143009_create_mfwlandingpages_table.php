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
            $table->string('guid');
            $table->string('name');
            $table->integer('cid')->references('id')->on('mfwlpcampaigns');
            $table->binary('landingPage');
        });
    }

    public function down() {
        Schema::drop('mfwlandingpages');
    }
}
