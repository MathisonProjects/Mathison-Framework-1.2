<?php namespace App;

	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	
	class mfwreports extends Eloquent {
	    protected $table = 'mfwreports';
		protected $fillable = ['name','description','jsonreportparsing'];

		public function processRequest($request) {
			$array = array(
					'object' => $request->input('object'),
					'fields' => $request->input('fields'),
					'filter' => $request->input('filter'),
					'totals' => $request->input('totals')
				);

			self::insert(['name' 		=> $request->input('name'),
						  'description' => $request->input('description'),
						  'jsonreportparsing' => json_encode($array)]);
		}

	}
?>