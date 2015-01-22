<?php namespace App\Http\Controllers;

use App\mfwobjects;
use App\mfwworkflows;

class SuperAdminController extends Controller {

	private $menu;
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

	public function viewRecords($objectName) {
		$menu = $this->menu;
		$data = mfwobjects::where('name', $objectName)->first();
		$description = $data->objectDescription;
		$fields = mfwobjects::where('oid', $data->id)->get();
		$objectName = ucwords(str_replace('_', ' ', $objectName));
		return view('superAdmin.view', compact('objectName','description','fields','menu'));
	}

	public function createObject() {
		$menu = $this->menu;
		return view('superAdmin.createObject', compact('menu'));
	}

	public function createObjectPost() {
		$post = $_POST;
		$workflow = self::workflowManage('createObjectPost','admin/super/view/');
		
		if ($workflow->default) {
			$redirect = $workflow->originaldestination.$this->sanitizeName($post['objectName']);
		} else {
			$redirect = $workflow->finaldestination;
		}
		
		mfwobjects::insert(['name' => $this->sanitizeName($post['objectName']),
			'objectDescription' => $post['objectDescription']]);
		$data = mfwobjects::where('name',$this->sanitizeName($post['objectName']))->first();
		$id = $data->id;

		for ($i = 1; $i <= $post['totalFields']; $i++) {
			mfwobjects::insert(['oid' => $id,
				'name' => $this->sanitizeName($post['objectItemFieldName'.$i]),
				'datatype' => $post['objectItemDataType'.$i],
				'dataquantity' => $post['objectItemQuantity'.$i]]);
		}

		return redirect($redirect);
	}

	public function viewObjects() {
		$menu = $this->menu;

		return view('superAdmin.viewObjects', compact('menu'));
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
		return $workflow;
	}
}
