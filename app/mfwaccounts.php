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
			$this->where('email', $request->input('email'));
			if ($this->password == md5($request->password.$this->hash)) {
				$this->sessionid = md5(time().$this->hash);
				$this->save();
				Session::put('sessionid', $this->sessionid);
			}
		}

		public function verify($hash) {
			$this->where('hash', $hash);
			$this->active = 1;
			$this->save();
		}

		public function getAccount() {
			$value = Session::get('sessionid', null);
			if ($value != null) {
				$this->where('sessionid', $value);
			}
			return $this;
		}

		public function logout() {
			Session::flush;
		}
	}
?>