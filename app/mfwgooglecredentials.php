<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwgooglecredentials extends Eloquent {
		protected $table = 'mfwgooglecredentials';
		protected $fillable = ['client_id','service_account_name','key','sub'];
	}
?>