<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwgoogledrives extends Eloquent {
		protected $table = 'mfwgoogledrives';
		protected $fillable = ['credentials','drive_key'];
	}
?>