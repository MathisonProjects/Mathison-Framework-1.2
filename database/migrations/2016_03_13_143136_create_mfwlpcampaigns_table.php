<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMfwlpcampaignsTable extends Migration
{
    public function up()
    {
        Schema::create('mfwlpcampaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
        });
    }

    public function down() {
        Schema::drop('mfwlpcampaigns');
    }
}
