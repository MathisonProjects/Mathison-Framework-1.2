<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use App\mfwmanageforms;
use App\mfwapis;
use App\mfwformprocessings;
use App\mfwtemplates;
use App\mfwpages;
use DB;

class SuperAdminController extends Controller {
	private $sharedData;

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
		return $this->launchView('workflows.viewWorkflow', $compact);
	}

	public function createWorkflow() {
		return $this->launchView('workflows.createWorkflow', array());
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

	public function createWorkflowPost() {
		$this->module['workflows']->insert(['default' => $this->post['default'],
				'workflowitem' => $this->sanitizeName($this->post['workflowitem']),
				'originaldestination' => $this->post['originaldestination'],
				'finaldestination' => $this->post['finaldestination']]);

		
	}

	public function createRelationshipPost() {
		$this->module['relationships']->insert(['name' => $this->sanitizeName($this->post['relationshipname']),
			'relationshiptype' => $this->post['relationshiptype'],
			'tableone' => $this->post['objectName'],
			'tabletwo' => $this->post['totable'],
			'fieldone' => $this->post['fromfield'],
			'fieldtwo' => $this->post['tofield']]);
		
	}

	public function viewObjectItem(mfwobjects $object, $id) {
		// Relationship Builder
		$allPrimaryRelationships       = $this->module['relationships']->where('tableone', $object->name)->get();
		$allSecondaryRelationships     = $this->module['relationships']->where('tabletwo', $object->name)->get();
		$this->sharedData['primary']   = array();
		$this->sharedData['secondary'] = array();
		// One to Many, A one, B many
		foreach ($allPrimaryRelationships as $primary) {
			$info['object'] = $primary->tabletwo;
			$info['data'] = DB::table($this->db_prefix.$primary->tableone.' as a')
								->join($this->db_prefix.$primary->tabletwo.' as b', 'a.'.$primary->fieldone, '=', 'b.'.$primary->fieldtwo)
								->where('a.id',$id)
								->get();
			
			array_push($this->sharedData['primary'], $info);
		}

		foreach ($allSecondaryRelationships as $secondary) {
			$info['object'] = $secondary->tableone;
			$info['data'] = DB::table($this->db_prefix.$secondary->tabletwo.' as a')
								->join($this->db_prefix.$secondary->tableone.' as b', 'a.'.$secondary->fieldtwo, '=', 'b.'.$secondary->fieldone)
								->where('a.id',$id)
								->get();

			array_push($this->sharedData['secondary'], $info);
		}
		// End Relationship Builder
		$sharedData = $this->sharedData;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$record = DB::table($this->db_prefix.$object->name)->where('id', $id)->get();
		return $this->launchView('objects.viewObjectItem', compact('sharedData','objectName','record','object'));
	}

	public function viewWorkflows() {
		return $this->launchView('workflows.viewWorkflows', array());
	}

	public function viewObjectAddRecord(array $array) {
		$objects = new mfwobjects;
		$objects->insertCustomData($this->db_prefix.$array[0],$array[1],$this->post);
		
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

	public function viewForm(mfwmanageforms $forms, $id) {
		$apiId = $this->module['apis']->where('fid', $id)->first()['randomid'];
		$forms->viewForm($id);
		return $this->launchView('forms.view', array('formItem' => $forms->form, 'apiId' => $apiId));
	}

	public function viewForms(mfwmanageforms $forms) {
		return $this->launchView('forms.views', array('formList' => $this->menu['forms']));
	}

	public function createForms() {
		return $this->launchView('forms.create', array());
	}

	public function createFormsPost(mfwmanageforms $forms) {
		$forms->createForm($this->post);
		
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