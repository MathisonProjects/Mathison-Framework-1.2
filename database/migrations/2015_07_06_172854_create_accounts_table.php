<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {
    public function up() {
        Schema::create('mfwaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('sessionid');
            $table->integer('accountlevel');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('hash');
            $table->integer('active');
        });
    }

    public function down() {
        Schema::drop('mfwaccounts');
    }
}
