<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiddlewareTable extends Migration {

	public function up()
	{
		Schema::create('mfwmiddlewares', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('randomid');
			$table->string('name');
			$table->string('targeturl');
			$table->binary('jsondefaults');
		});
	}

	public function down() {
		Schema::drop('mfwmiddlewares');
	}
}
