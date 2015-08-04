<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleDriveTable extends Migration {

    public function up() {
        Schema::create('mfwgooglecredentials', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('client_id');
            $table->string('service_account_name');
            $table->string('key');
            $table->string('sub');
        });

        Schema::create('mfwgoogledrives', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('credentials')->unsigned();
            $table->string('drive_key');
            $table->foreign('credentials')->references('id')->on('mfwgooglecredentials');
        });
    }

    public function down() {
        Schema::drop('mfwgooglecredentials');
        Schema::drop('mfwgoogledrives');
    }
}
