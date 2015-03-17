<?php namespace App;
	
	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;

	class mfwmanageforms extends Eloquent {
		var $allForms;
		var $form = array();

		public function createForm($post) {
			self::insert(['name' => $post['formName'],
				'description' => $post['formDescription']]);
			$form = self::where('name', $post['formName'])->first();
			$fid = $form->id;
			
			if (isset($post['customform'])) {
				foreach ($post['customform'] as $key => $value) {
					$fieldType  = '';
					$fieldValue = '';
					$list       = '';
					$fieldOrder = $post['order'][$key];
					foreach ($value as $key2 => $value2) {
						if ($key2 == 0) {
							foreach ($value2 as $key3 => $value3) {
								$fieldType = $key3;
								$fieldValue = $value3;
							}
						} else if ($key2 == 1) {
							$list = $value2['data'];
						}
					}

					self::insert(['name' => $fieldValue,
					'fid'                => $fid,
					'fieldType'          => $fieldType,
					'fieldOptions'       => $list,
					'fieldOrder'         => $fieldOrder]);
				}
			}
		}

		public function viewAllForms() {
			$this->allForms = self::where('fid', '=', '0')->get();
		}

		public function viewForm($id) {
			$this->form[0] = self::where('id', '=', $id)->first();
			$this->form[1] = self::where('fid','=', $id)->orderBy('fieldOrder')->get();
		}

	}

?>