<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mfwobjects;
use App\mfwworkflows;
use DB;

class SuperAdminController extends Controller {
	public function index() {
		return $this->launchView('index', array());
	}

	public function viewRecords(mfwobjects $object) {	
		$fields = $this->module['objects']->where('oid', $object->id)->get();
		$records = DB::table($this->db_prefix.$object->name)->get();
		$description = $object->objectDescription;
		$dbName = $object->name;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		return $this->launchView('objects.view', compact('objectName', 'dbName', 'records', 'description','fields'));
	}

	public function viewWorkflow(mfwworkflows $entry) {
		$compact = array(
			'fields' => DB::select(" SHOW COLUMNS FROM mfwworkflows"),
			'workflowName' => ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', ' $1', str_replace('_', ' ', $entry->workflowitem))),
			'entry' => $entry);
		return $this->launchView('workflows.view', $compact);
	}

	public function createObjectPost() {
		$this->module['objects']->insert(['name' => $this->sanitizeName($this->post['objectName']),
			'objectDescription' => $this->post['objectDescription']]);
		$data = $this->module['objects']->where('name',$this->sanitizeName($this->post['objectName']))->first();
		$id = $data->id;

		for ($i = 1; $i <= $this->post['totalFields']; $i++) {
			$this->module['objects']->insert(['oid' => $id,
				'name'         => $this->sanitizeName($this->post['objectItemFieldName'.$i]),
				'datatype' 	   => $this->post['objectItemDataType'.$i],
				'dataquantity' => $this->post['objectItemQuantity'.$i]]);
		}

		$fields = $this->module['objects']->where('oid', $id)->get();
		$this->module['objects']->createTable($this->db_prefix.$this->post['objectName'], $fields);
	}

	public function viewObjectItem(mfwobjects $object, $id) {
		// Relationship Builder
		$sharedDataArray = array();
		$allPrimaryRelationships       = $this->module['relationships']->where('tableone', $object->name)->get();
		$allSecondaryRelationships     = $this->module['relationships']->where('tabletwo', $object->name)->get();
		$sharedDataArray['primary']   = array();
		$sharedDataArray['secondary'] = array();
		// One to Many, A one, B many
		foreach ($allPrimaryRelationships as $primary) {
			$info['object'] = $primary->tabletwo;
			$info['data'] = DB::table($this->db_prefix.$primary->tableone.' as a')
								->join($this->db_prefix.$primary->tabletwo.' as b', 'a.'.$primary->fieldone, '=', 'b.'.$primary->fieldtwo)
								->where('a.id',$id)
								->get();
			
			array_push($sharedDataArray['primary'], $info);
		}

		foreach ($allSecondaryRelationships as $secondary) {
			$info['object'] = $secondary->tableone;
			$info['data'] = DB::table($this->db_prefix.$secondary->tabletwo.' as a')
								->join($this->db_prefix.$secondary->tableone.' as b', 'a.'.$secondary->fieldtwo, '=', 'b.'.$secondary->fieldone)
								->where('a.id',$id)
								->get();

			array_push($sharedDataArray['secondary'], $info);
		}
		// End Relationship Builder
		$sharedData = $sharedDataArray;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$record = DB::table($this->db_prefix.$object->name)->where('id', $id)->get();
		return $this->launchView('objects.viewObjectItem', compact('sharedData','objectName','record','object'));
	}

	public function viewObjectAddRecord(array $array) {
		$this->module['objects']->insertCustomData($this->db_prefix.$array[0],$array[1],$this->post);
	}
	public function editObjectItem(mfwobjects $object, $id) {
		$compact = array(
			'objectName' => ucwords(str_replace('_', ' ', $object->name)),
			'fields' => $this->module['objects']->where('oid', $object->id)->get(),
			'record' => DB::table($this->db_prefix.$object->name)->where('id', $id)->first(),
			'object' => $object);

		return $this->launchView('objects.editObjectItem', $compact);
	}

	public function editObjectItemPost(mfwobjects $object, $id)	{
		foreach ($this->post as $key => $value) {
			if ($key != 'id' && $key != 'objectName' && $key != '_token') {
				$update[$key] = $value;
			}
		}
		DB::table($this->db_prefix.$this->post['objectName'])
				->where('id', $this->post['id'])
				->update($update);
		
	}

	private function launchView($view,$compact) {
		$compact['menu'] = $this->menu;
		return view('superAdmin.'.$view,$compact);
	}

	public function getObjectFields(array $array) {
		return json_encode($array[1]);
	}

	public function installRequired() {
		return null;
	}

	public function viewRequired() {
		return null;
	}
}