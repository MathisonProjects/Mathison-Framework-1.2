<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mfwtemplates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('templatename')->nullable(); //Page Data
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
        Schema::drop('mfwtemplates');
    }
}
