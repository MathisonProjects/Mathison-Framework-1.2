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
			$table->string('apiid');
			$table->string('eventlocation');
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
