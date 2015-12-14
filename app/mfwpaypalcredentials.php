<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwpaypalcredentials extends Eloquent {
	    protected $table = 'mfwpaypal_credentials';
		protected $fillable = ['client_id','client_secret','sandbox'];
	}
?>