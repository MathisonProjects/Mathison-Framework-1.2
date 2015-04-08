<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mfwobjects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('oid')->default('0');
			$table->string('name');
			$table->string('objectDescription')->nullable();
			$table->string('datatype')->nullable();
			$table->string('dataquantity')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mfwobjects');
	}

}
