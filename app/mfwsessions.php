<?php namespace App;

	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	use Session;
	
	class mfwsessions extends Eloquent {
	    protected $table = 'mfwsessions';
		protected $fillable = ['name'];

		public function startSessions() {
			foreach (self::get() as $var) {
				if (!session($var->name)) {
					Session::put($var->name, '');
				}
			}
		}

		public function editSession($session,$value) {
			Session::put($session, $value);
		}

		public function deleteSession($session) {
			Session::forget($session);
			Session::put($session, '');
		}

		public function flushSessions() {
			Session::flush();
		}
	}
?>