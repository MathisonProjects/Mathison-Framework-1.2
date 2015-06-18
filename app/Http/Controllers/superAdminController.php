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
		$fields = mfwobjects::where('oid', $object->id)->get();
		$object->createTable($this->db_prefix.$object->name, $fields);
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
		$redirect = self::workflowManage('objects.createObjectPost','admin/super/viewObjects/');
		
		mfwobjects::insert(['name' => $this->sanitizeName($this->post['objectName']),
			'objectDescription' => $this->post['objectDescription']]);
		$data = mfwobjects::where('name',$this->sanitizeName($this->post['objectName']))->first();
		$id = $data->id;

		for ($i = 1; $i <= $this->post['totalFields']; $i++) {
			mfwobjects::insert(['oid' => $id,
				'name' => $this->sanitizeName($this->post['objectItemFieldName'.$i]),
				'datatype' => $this->post['objectItemDataType'.$i],
				'dataquantity' => $this->post['objectItemQuantity'.$i]]);
		}

		return redirect($redirect);
	}

	public function createWorkflowPost() {
		$redirect = self::workflowManage('createWorkflowPost','admin/super/viewWorkflow/');

		mfwworkflows::insert(['default' => $this->post['default'],
				'workflowitem' => $this->sanitizeName($this->post['workflowitem']),
				'originaldestination' => $this->post['originaldestination'],
				'finaldestination' => $this->post['finaldestination']]);

		return redirect($redirect);
	}

	public function createRelationshipPost() {
		$redirect = self::workflowManage('createRelationshipPost','admin/super/viewRelationship/');
		mfwobjectrelationships::insert(['name' => $this->sanitizeName($this->post['relationshipname']),
			'relationshiptype' => $this->post['relationshiptype'],
			'tableone' => $this->post['objectName'],
			'tabletwo' => $this->post['totable'],
			'fieldone' => $this->post['fromfield'],
			'fieldtwo' => $this->post['tofield']]);
		return redirect($redirect);
	}

	public function viewObjectItem(mfwobjects $object, $id) {
		// Relationship Builder
		$allPrimaryRelationships       = mfwobjectrelationships::where('tableone', $object->name)->get();
		$allSecondaryRelationships     = mfwobjectrelationships::where('tabletwo', $object->name)->get();
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
		$redirect = self::workflowManage('addRecordPost','admin/super/viewObject/');
		$objects = new mfwobjects;
		$objects->insertCustomData($this->db_prefix.$array[0],$array[1],$this->post);
		return redirect($redirect);
	}
	public function editObjectItem(mfwobjects $object, $id) {
		$compact = array(
			'objectName' => ucwords(str_replace('_', ' ', $object->name)),
			'fields' => mfwobjects::where('oid', $object->id)->get(),
			'record' => DB::table($this->db_prefix.$object->name)->where('id', $id)->first(),
			'object' => $object);

		return $this->launchView('objects.editObjectItem', $compact);
	}

	public function editObjectItemPost(mfwobjects $object, $id)
	{
		$redirect = self::workflowManage('editRecordPost','admin/super/viewObject/');
		foreach ($this->post as $key => $value) {
			if ($key != 'id' && $key != 'objectName' && $key != '_token') {
				$update[$key] = $value;
			}
		}
		DB::table($this->db_prefix.$this->post['objectName'])
				->where('id', $this->post['id'])
				->update($update);
		return redirect($redirect);
	}

	public function viewForm(mfwmanageforms $forms, $id) {
		$apiId = mfwapis::where('fid', $id)->first()['randomid'];
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
		$redirect = self::workflowManage('createFormPost','admin/super/viewForms/');
		$forms->createForm($this->post);
		return redirect($redirect);
	}

	public function createApiPost() {
		$redirect = self::workflowManage('createApiPost','admin/super/viewApis/');
		return redirect($redirect);
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

	private function workflowManage($postName, $defaultDestination) {
		$workflow = mfwworkflows::where('workflowitem', $postName)->first();
		if (!$workflow) {
			mfwworkflows::insert(['default' => true,
				'workflowitem' => $postName,
				'originaldestination' => $defaultDestination]);
			$workflow = mfwworkflows::where('workflowitem', $postName)->first();
		}

		if ($workflow->default) {
			$extra = '';
			if ($postName == 'createObjectPost' || $postName == 'addRecordPost') {
				$extra = $this->sanitizeName($this->post['objectName']);
			} else if ($postName == 'createWorkflowPost') {
				$extra = $this->sanitizeName($this->post['workflowitem']);
			} else if ($postName == 'createRelationshipPost') {
				$extra = $this->sanitizeName($this->post['relationshipname']);
			} else if ($postName == 'editRecordPost') {
				$extra = $this->sanitizeName($this->post['objectName']).'/'.$this->post['id'];
			} 

			$redirect = $workflow->originaldestination.$extra;
		} else {
			$redirect = $workflow->finaldestination;
		}

		return $redirect;
	}
}