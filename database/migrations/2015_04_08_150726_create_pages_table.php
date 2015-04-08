<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mfwpages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('stringurl')->nullable();
            $table->integer('tid')->nullable(); //Template ID
            $table->binary('datatext')->nullable(); //Template Data
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mfwpages');
    }
}
