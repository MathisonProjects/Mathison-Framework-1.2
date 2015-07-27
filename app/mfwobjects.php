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
			if (!Schema::hasTable($tablename)) {
				Schema::create($tablename, function(Blueprint $table) {
					foreach ($this->fields as $field) {
						if ($field->name == 'id') {
							$table->increments('id');
						} elseif ($field->datatype == 'varchar') {
							$table->string($field->name, $field->dataquantity)->default($field->defaultval);
						} elseif ($field->datatype == 'int') {
							$table->integer($field->name)->default($field->defaultval);
						} elseif ($field->datatype == 'blob') {
							$table->binary($field->name)->default($field->defaultval);
						} elseif ($field->datatype == 'datetime') {
							$table->dateTime($field->name)->default($field->defaultval);
						} elseif ($field->datatype == 'decimal') {
							$table->decimal($field->name, 8, 3)->default($field->defaultval);
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
			DB::table($datatable)->insert($input);
		}

		public function dropCustomTables($prefix,$id) {
			$objectData = self::where('id', $id)->first();
			self::where('id', $id)->delete();
			self::where('oid', $id)->delete();
			Schema::drop($prefix.$objectData->name);
		}
	}
?>