<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwobjects extends Eloquent {
		private static $fields;
		public function createTable($tablename,$fields) {
			$this->fields = $fields;
			if (!Schema::hasTable('mfwcus_'.$tablename)) {
				Schema::create('mfwcus_'.$tablename, function(Blueprint $table) {
					foreach ($this->fields as $field) {
						if ($field->name == 'id') {
							$table->increments('id');
						} elseif ($field->datatype == 'varchar') {
							$table->string($field->name, $field->dataquantity)->nullable();
						} elseif ($field->datatype == 'int') {
							$table->integer($field->name)->nullable();
						} elseif ($field->datatype == 'blob') {
							$table->binary($field->name)->nullable();
						}
					}
				});
			}
		}

		public function insertCustomData($datatable,$fields,$post) {
			$input = array();
			foreach ($fields as $field) {
				if ($field->name != 'id') {
					$input[$field->name] = $post[$field->name];
				}
			}
			DB::table('mfwcus_'.$datatable)->insert($input);
		}
	}
?>