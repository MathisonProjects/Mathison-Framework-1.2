<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronsTable extends Migration {
    public function up() {
        Schema::create('mfwcrons', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('frequency');
            $table->dateTime('lastran');
            $table->binary('jsondata');
        });

        //
        //  array(
        // 'oid'         => OBJECTID,
        // 'modtype'     => MODTYPE,
        // 'field'       => FIELDID,
        // 'modifier'    => QUANTITY,
        // 'conditional' => CONDITIONAL);
        //
    }

    public function down() {
        Schema::drop('mfwcrons');
    }
}
