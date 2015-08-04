<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateObjectsTable extends Migration {
    public $db_prefix = 'mfwcus_';
	public function up() {
		Schema::create('mfwobjects', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('oid')->default('0');
			$table->string('name');
			$table->string('objectDescription')->nullable();
			$table->string('datatype')->nullable();
			$table->string('dataquantity')->nullable();
			$table->string('defaultval')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$tables = DB::table('mfwobjects')->where('oid', 0)->get();
		foreach ($tables as $table) {
			Schema::drop($this->db_prefix.$table->name);
		}
		Schema::drop('mfwobjects');
	}

}
