<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	class mfwworkflows extends Eloquent {

	    protected $table = 'mfwworkflows';
		protected $fillable = ['name', 'referrerOrigin', 'originaldestination','finaldestination','default','redirect'];

		public $referrer;

		public function setReferrer($value) {
			$this->referrer = $value;
			return $this;
		}

		public function checkWorkflowItem() {
			$data = self::where('referrerOrigin', $this->referrer)->first();

			if (self::count() == 0) {
				$redirect = 0;
			} else {
				$redirect = 1;
			}

			if ($data != null) {
				return $data;
			} else {
				self::insert([array(
					'default'             => 1,
					'redirect'			  => $redirect,
					'name'                => 'N/A',
					'referrerOrigin'      => $this->referrer,
					'originaldestination' => $this->referrer,
					'finaldestination'    => '')]);
				$data = self::where('referrerOrigin', $this->referrer)->first();
				return $data;
			}
		}

	}
?>