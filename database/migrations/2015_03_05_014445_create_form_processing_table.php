<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormProcessingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('mfwformprocessings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('aid'); // API Id
			$table->integer('executionorder');
			$table->string('processor');
			$table->string('method');
			$table->string('data1');
			$table->string('data2');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('mfwformprocessings');
	}

}
