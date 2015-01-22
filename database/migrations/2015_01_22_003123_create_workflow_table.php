<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mfwworkflows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->boolean('default');
			$table->string('workflowitem');
			$table->string('originaldestination');
			$table->string('finaldestination')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mfwworkflows');
	}

}
