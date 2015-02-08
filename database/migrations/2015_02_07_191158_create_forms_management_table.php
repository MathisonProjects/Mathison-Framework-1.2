<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mfwmanageforms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('fieldOrder')->default('0');
			$table->string('name');
			$table->string('description');
			$table->integer('fid')->default('0');
			$table->integer('oid');
			$table->integer('fieldtype');
			$table->string('fieldoptions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mfwmanageforms');
	}

}
