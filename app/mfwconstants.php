<?php namespace App;

	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	
	class mfwconstants extends Eloquent {
	    protected $table = 'mfwconstants';
		protected $fillable = ['name','value'];

		public $const;

		public function setConst() {
			foreach (self::get() as $var) {
				$const[$var->name] = $var->value;
			}
			return $this;
		}
	}
?>