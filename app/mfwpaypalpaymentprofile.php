<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwpaypalpaymentprofile extends Eloquent {
	    protected $table = 'mfwpaypal_paymentprofile';
		protected $fillable = ['owner','payment_id','last_four','cid'];
	}
?>