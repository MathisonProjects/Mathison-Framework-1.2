<?php namespace App;
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	use Session;

	class mfwaccounts extends Eloquent {
	    protected $table = 'mfwaccounts';
		protected $fillable = ['sessionid','accountlevel','email','username','password','hash','active'];

		public function register($request) {
			$this->create($request->input());
		}

		public function login($request) {
			Session::pull('sessionid');
			$data = self::where('email', $request->input('email'))->first();
			if ($data->password == md5($request->input('password').$data->hash) && $data->active == 1) {
				$data->sessionid = md5(time().$data->hash);
				$data->save();
				Session::put('sessionid', $data->sessionid);
			}
		}

		public function verify($hash) {
			$this->where('hash', $hash);
			$this->active = 1;
			$this->save();
		}

		public function getAccount() {
			$value = Session::get('sessionid');

			$data = null;
			if ($value != null) {
				$data = self::where('sessionid', $value)->first();
			}
			return $data;
		}

		public function logout() {
			Session::flush;
		}
	}
?>