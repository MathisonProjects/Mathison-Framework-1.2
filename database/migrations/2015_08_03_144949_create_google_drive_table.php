<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleDriveTable extends Migration {

    public function up() {
        Schema::table('mfwcgoogleredentials', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('client_id');
            $table->string('service_account_name');
            $table->string('key');
            $table->string('sub');
        });

        Schema::table('mfwgoogledrives', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('credentials');
            $table->string('drive_key');
            $table->foreign('credentials')->references('id')->on('mfwcgoogleredentials');
        });
    }

    public function down() {
        Schema::drop('mfwcgoogleredentials');
        Schema::drop('mfwgoogledrives');
    }
}
