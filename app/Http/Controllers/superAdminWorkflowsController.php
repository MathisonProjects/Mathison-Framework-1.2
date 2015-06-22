<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class superAdminWorkflowsController extends Controller {

	public function index() {
		$tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
		$keys = array('View', 'Edit', 'Delete', 'Workflow Name', 'Default', 'Referrer', 'Old Destination', 'New Destination');
		$items = array();
		foreach ($this->menu['workflows'] as $key => $item) {
			array_push($items, array('<a href="/admin/super/workflows/'.$item->id.'"><i><span class="glyphicon glyphicon-eye-open"></span></i></a>',
									 '<a href="/admin/super/workflows/'.$item->id.'/edit"><i><span class="glyphicon glyphicon-edit"></span></i></a>',
									 '<a href="/admin/super/workflows/'.$item->id.'/delete"><i><span class="glyphicon glyphicon-remove"></span></i></a>',
									 $item->name,
									 $item->default,
									 $item->referrerOrigin,
									 $item->originaldestination,
									 $item->finaldestination));
		}

		$table = $tableBuilder->setKeys($keys)->
					setValues($items)->
					buildTable();
		return $this->launchView('workflows.views', array('table' => $table));
	}

	public function create() {
		return $this->launchView('workflows.create', array());
	}

	public function store() {
		$this->module['workflows']->insert(['default' => $this->post['default'],
			'workflowitem' => $this->sanitizeName($this->post['workflowitem']),
			'originaldestination' => $this->post['originaldestination'],
			'finaldestination' => $this->post['finaldestination']]);
	}

	public function show($id) {
		$entry = $this->module['workflows']->where('id',$id)->first();
		$compact = array(
			'fields' => DB::select(" SHOW COLUMNS FROM mfwworkflows"),
			'workflowName' => ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', ' $1', str_replace('_', ' ', $entry->workflowitem))),
			'entry' => $entry);
		return $this->launchView('workflows.view', $compact);
	}

	public function edit($id) {
		//
	}

	public function update($id) {
		//
	}

	public function destroy($id) {
		//
	}
	
	private function launchView($view,$compact) {
		$compact['menu'] = $this->menu;
		return view('superAdmin.'.$view,$compact);
	}
}
