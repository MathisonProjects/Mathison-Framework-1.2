<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCraigslistListsTable extends Migration {

    public function up() {
        Schema::create('mfwcraigslistLists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('url');
        });
    }

    public function down() {
        Schema::drop('mfwcraigslistLists');
    }
}
