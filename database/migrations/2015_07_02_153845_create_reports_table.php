<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {
    public function up() {
        Schema::create('mfwreports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
            $table->binary('jsonreportparsing');
        });
    }

    public function down() {
        Schema::drop('mfwreports');
    }
}
