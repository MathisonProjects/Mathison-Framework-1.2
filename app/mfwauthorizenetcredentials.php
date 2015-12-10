<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwauthorizenetcredentials extends Eloquent {
	    protected $table = 'mfwauthorizenet_credentials';
		protected $fillable = ['api_login_id','transaction_key','sandbox'];
	}
?>