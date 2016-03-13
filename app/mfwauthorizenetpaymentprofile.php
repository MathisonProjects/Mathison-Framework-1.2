<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwauthorizenetpaymentprofile extends Eloquent {
	    protected $table = 'mfwauthorizenet_paymentprofile';
		protected $fillable = ['owner','authorize_id_customer','authorize_id_cc','last_four','cid'];
	}
?>