<?php namespace App\Http\Controllers;

use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use DB;

class SuperAdminController extends Controller {

	private $menu;
	private $post;
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

	public function viewObjects() {
		$menu = $this->menu;

		return view('superAdmin.viewObjects', compact('menu'));
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

	public function installRequired() {
		return null;
	}

	public function viewRequired() {
		return null;
	}

	public function relationships() {
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
			if (isset($this->post['objectName'])) {
				$extra = $this->sanitizeName($this->post['objectName']);
			}
			else if (isset($this->post['workflowitem'])) {
				$extra = $this->sanitizeName($this->post['workflowitem']);
			}

			$redirect = $workflow->originaldestination.$extra;
		} else {
			$redirect = $workflow->finaldestination;
		}

		return $redirect;
	}
}