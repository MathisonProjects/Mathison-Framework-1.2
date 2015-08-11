<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronsTable extends Migration {
    public function up() {
        Schema::create('mfwcrons', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->integer('active');
            $table->integer('oid');
            $table->integer('fid');
            $table->string('modtype');
            $table->double('modifier');
            $table->string('frequency');
            $table->dateTime('lastran');
        });

        //
        //  array(
        // 'conditional' => CONDITIONAL);
        //
    }

    public function down() {
        Schema::drop('mfwcrons');
    }
}
