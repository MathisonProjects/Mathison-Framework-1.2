<?php namespace App\Http\Controllers;

use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use DB;

class SuperAdminController extends Controller {

	private $menu;
	private $post;
	private $sharedData;
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->menu['objects'] = mfwobjects::where('oid', 0)->get();
		$this->menu['workflows'] = mfwworkflows::get();
		$this->menu['relationships'] = mfwobjectrelationships::get();
		if (isset($_POST)) {
			$this->post = $_POST;
		}
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index() {
		$menu = $this->menu;
		return view('superAdmin.index', compact('menu'));
	}

	public function viewRecords(mfwobjects $object) {	
		$fields = mfwobjects::where('oid', $object->id)->get();
		$object->createTable($object->name, $fields);
		$records = DB::table('mfwcus_'.$object->name)->get();
		$menu = $this->menu;
		$description = $object->objectDescription;
		$dbName = $object->name;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		return view('superAdmin.view', compact('objectName', 'dbName', 'records', 'description','fields','menu'));
	}

	public function viewWorkflow(mfwworkflows $entry) {
		$menu = $this->menu;
		$fields = DB::select(" SHOW COLUMNS FROM mfwworkflows");
		$workflowName = ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/',
			' $1',
			str_replace('_',
				' ',
				$entry->workflowitem)));
		return view('superAdmin.viewWorkflow', compact('workflowName','fields','entry','menu'));
	}

	public function viewRelationship(mfwobjectrelationships $relationship) {
		$menu = $this->menu;
		$relationshipName = ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/',
			' $1',
			str_replace('_',
				' ',
				$relationship->name)));
		return view('superAdmin.viewRelationship', compact('relationshipName','relationship','menu'));
	}

	public function createObject() {
		$menu = $this->menu;
		return view('superAdmin.createObject', compact('menu'));
	}

	public function createWorkflow() {
		$menu = $this->menu;
		return view('superAdmin.createWorkflow', compact('menu'));
	}

	public function createObjectPost() {
		$redirect = self::workflowManage('createObjectPost','admin/super/viewObject/');
		
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

	public function viewObjects() {
		$menu = $this->menu;

		return view('superAdmin.viewObjects', compact('menu'));
	}

	public function viewRelationships()
	{
		$menu = $this->menu;

		return view('superAdmin.viewRelationships', compact('menu'));
	}

	public function viewObjectItem(mfwobjects $object, $id) {
		$menu = $this->menu;

		// Relationship Builder
		$allPrimaryRelationships       = mfwobjectrelationships::where('tableone', $object->name)->get();
		$allSecondaryRelationships     = mfwobjectrelationships::where('tabletwo', $object->name)->get();
		$this->sharedData['primary']   = array();
		$this->sharedData['secondary'] = array();
		// One to Many, A one, B many
		foreach ($allPrimaryRelationships as $primary) {
			$info['object'] = $primary->tabletwo;
			$info['data'] = DB::table('mfwcus_'.$primary->tableone.' as a')
								->join('mfwcus_'.$primary->tabletwo.' as b', 'a.'.$primary->fieldone, '=', 'b.'.$primary->fieldtwo)
								->where('a.id',$id)
								->get();
			
			array_push($this->sharedData['primary'], $info);
		}

		foreach ($allSecondaryRelationships as $secondary) {
			$info['object'] = $secondary->tableone;
			$info['data'] = DB::table('mfwcus_'.$secondary->tabletwo.' as a')
								->join('mfwcus_'.$secondary->tableone.' as b', 'a.'.$secondary->fieldtwo, '=', 'b.'.$secondary->fieldone)
								->where('a.id',$id)
								->get();

			array_push($this->sharedData['secondary'], $info);
		}
		// End Relationship Builder
		$sharedData = $this->sharedData;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$record = DB::table('mfwcus_'.$object->name)->where('id', $id)->get();
		return view('superAdmin.viewObjectItem', compact('menu','sharedData','objectName','record','object'));
	}

	public function viewWorkflows() {
		$menu = $this->menu;
		return view('superAdmin.viewWorkflows', compact('menu'));
	}

	public function viewObjectAddRecord(array $array) {
		$redirect = self::workflowManage('addRecordPost','admin/super/viewObject/');
		$objects = new mfwobjects;
		$objects->insertCustomData($array[0],$array[1],$this->post);
		return redirect($redirect);
	}
	public function editObjectItem(mfwobjects $object, $id) {
		$menu = $this->menu;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$fields = mfwobjects::where('oid', $object->id)->get();
		$record = DB::table('mfwcus_'.$object->name)->where('id', $id)->first();
		return view('superAdmin.editObjectItem', compact('menu','objectName','fields','record','id','object'));
	}

	public function editObjectItemPost(mfwobjects $object, $id)
	{
		$redirect = self::workflowManage('editRecordPost','admin/super/viewObject/');
		foreach ($this->post as $key => $value) {
			if ($key != 'id' && $key != 'objectName' && $key != '_token') {
				$update[$key] = $value;
			}
		}
		DB::table('mfwcus_'.$this->post['objectName'])
				->where('id', $this->post['id'])
				->update($update);
		return redirect($redirect);
	}

	public function viewForms() {
		$menu = $this->menu;
		return view('superAdmin.viewForms', compact('menu'));
	}

	public function createForms() {
		$menu = $this->menu;
		return view('superAdmin.createForm', compact('menu'));
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

	private function sanitizeName($field) {
		return str_replace(' ', '_', $field);
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