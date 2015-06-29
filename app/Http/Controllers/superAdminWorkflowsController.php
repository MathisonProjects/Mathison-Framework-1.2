<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class superAdminWorkflowsController extends Controller {

	public function index() {
		$tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
			$keys = array('View'                                                                                                          , 'Edit'                                                                                                          , 'Delete'                                                                                                            , 'Workflow Name' , 'Default'      , 'Referrer'            , 'Old Destination'          , 'New Destination');
		$items = array();
		foreach ($this->menu['workflows'] as $key => $item) {
			$array = array('<a href="/admin/super/workflows/'.$item->id.'"><i><span class="glyphicon glyphicon-eye-open"></span></i></a>' , '<a href="/admin/super/workflows/'.$item->id.'/edit"><i><span class="glyphicon glyphicon-edit"></span></i></a>' , '<a href="/admin/super/workflows/'.$item->id.'/delete"><i><span class="glyphicon glyphicon-remove"></span></i></a>' , $item->name     , $item->default , $item->referrerOrigin , $item->originaldestination , $item->finaldestination);
			array_push($items, $array);
		}

		$table = $tableBuilder->setKeys($keys)->
					setValues($items)->
					buildTable();
		return $this->launchView('views', array('table' => $table));
	}

	public function create() {
		return $this->launchView('create', array());
	}

	public function store(request $request) {
        parent::save('workflows','create',$request);
	}

	public function show($id) {
		$entry = $this->module['workflows']->where('id',$id)->first();
		$compact = array(
			'fields' => DB::select(" SHOW COLUMNS FROM mfwworkflows"),
			'workflowName' => ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', ' $1', str_replace('_', ' ', $entry->workflowitem))),
			'entry' => $entry);
		return $this->launchView('view', $compact);
	}

	public function edit($id) {
		$workflow = $this->module['workflows']->where('id', $id)->first();
        return $this->launchView('edit', array('workflow' => $workflow));
	}

	public function update($id,request $request) {
        parent::save('workflows','update',$request, array('id' => $id));
	}

	public function destroy($id) {
		$this->module['workflows']->destroy($id);
		return redirect('superAdmin.workflows');
	}
}
