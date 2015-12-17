<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwformprocessing extends Eloquent {

	    protected $table = 'mfwformprocessing';
		protected $fillable = ['name','aid','nextFid','data'];
	}
?>