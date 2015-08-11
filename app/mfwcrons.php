<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwcrons extends Eloquent {
	    protected $table = 'mfwcrons';
		protected $fillable = ['name','description','active','oid','fid','modtype','modifier','frequency','lastran'];
	}
?>