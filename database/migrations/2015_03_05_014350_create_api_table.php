<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mfwapis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('randomid');
			$table->string('action');
			$table->string('name');
			$table->integer('oid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mfwapis');
	}

}
