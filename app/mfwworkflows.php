<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	class mfwworkflows extends Eloquent {
		public $referrer;
		public $destination;
		public $finaldestination;

		public function setReferrer($value) {
			$this->referrer = $value;
			return $this;
		}

		public function setDestination($value) {
			$this->destination = $value;
			return $this;
		}

		public function setFinalDestination($value) {
			$this->finaldestination = $value;
			return $this;
		}
		
		public function checkWorkflowItem() {
			$data = self::where('referrerOrigin', $this->referrer)->first();

			if ($data != null) {
				return $data;
			} else {
				self::insert([array(
					'default'             => 1,
					'name'                => '',
					'referrerOrigin'      => $this->referrer,
					'originaldestination' => $this->referrer,
					'finaldestination'    => '')]);
				$data = self::where('referrerOrigin', $this->referrer)->first();
				return $data;
			}
		}

	}
?>