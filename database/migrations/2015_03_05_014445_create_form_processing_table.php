<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormProcessingTable extends Migration {

	public function up()
	{
		Schema::create('mfwformprocessing', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('aid');
			$table->integer('nextFid');
			$table->string('data');
		});
	}

	public function down()
	{
		Schema::drop('mfwformprocessing');
	}
}
