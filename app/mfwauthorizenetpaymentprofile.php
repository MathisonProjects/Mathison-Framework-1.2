<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwauthorizenetpaymentprofile extends Eloquent {
	    protected $table = 'mfwauthorizenet_paymentprofile';
		protected $fillable = ['owner','authorize_id','last_four','cid'];
	}
?>