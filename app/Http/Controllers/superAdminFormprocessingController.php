<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminFormProcessingController extends Controller {

	public function index() {
		$keys = array('View', 'Edit', 'Delete', 'Id', 'Name', 'Next');
        $items = array();
        foreach ($this->menu['formProcessing'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/formProcessing/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
            	'<a href="/admin/super/formProcessing/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
            	'<a href="/admin/super/formProcessing/'.$item->id.'/delete">'.$this->vedIcon['Delete'].'</a>',
            	$item->id,
            	$item->name,
            	$item->nextFid));
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
	}

	public function create() {
		$nextFid = ['' => 'None'];
		$aid = ['' => 'Select an option'];

		$processes = $this->module['formProcessing']->get();
		$apis      = $this->module['apis']->get();

		foreach ($apis as $key => $api) {
			$aid[$api->id] = $api->name;
		}

		foreach ($processes as $key => $process) {
			$nextFid[$process->id] = $process->name;
		}

        return $this->launchView('create', array('nextFid' => $nextFid, 'aid' => $aid));
	}

	public function store(Request $request) {
		$request->merge(array('data' => json_encode($request->input('data'))));
        parent::save('create',$request);
        return redirect()->back()->with('Alert', $this->messages(1));
	}

	public function show($id) {
        return $this->launchView('view');
	}

	public function edit($id) {
		$data = $this->module[$this->currentModule]->where('id', $id)->first();
		$nextFid = ['' => 'None'];
		$aid = ['' => 'Select an option'];
		$processes = $this->module['formProcessing']->get();
		$apis      = $this->module['apis']->get();

		foreach ($apis as $key => $api) {
			$aid[$api->id] = $api->name;
		}

		foreach ($processes as $key => $process) {
			$nextFid[$process->id] = $process->name;
		}

		$fields = [];

		$api = $this->module['apis']->where('id', $data->id)->first();
		$objectFields = $this->module['objects']->where('oid', $api->oid)->get();

		foreach ($objectFields as $key => $field) {
			if ($field->name != 'id') {
				$fields[$field->id] = $field->name;
			}
		}

        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data, 'nextFid' => $nextFid, 'aid' => $aid, 'edit' => '', 'fields' => $fields));
	}

	public function update($id, request $request) {
		$request->merge(array('data' => json_encode($request->input('data'))));
        parent::save('update',$request, array('id' => $id));
        return redirect()->back()->with('Alert', $this->messages(2));
	}

	public function destroy($id) {
		//
	}

	public function apiCall(Request $request) {
		$api    = $this->module['apis']->where('randomid', $request->get('apiId'))->first();
		$object = $this->module['objects']->where('id', $api['oid'])->first();
 		$input = array();
 		foreach ($request->input() as $key => $value) {
 			if ($key != '_token' && $key != 'apiId') {
 				$input[$key] = $value;
 			}
 		}
 
 		if ($api['action'] == 'create') {
 			DB::table($this->db_prefix.$object['name'])->insert($input);
 		} else if ($api['action'] == 'update') {
 			DB::table($this->db_prefix.$object['name'])->where('id', $request->get('id'))->update($input);
 		}
	}

	    private function messages($id) {
        if ($id == 1) {
            return $this->alertGenerate('success', 'Form Process Created');
        } else if ($id == 2) {
            return $this->alertGenerate('success', 'Form Process Edited');
        } else if ($id == 3) {
            return $this->alertGenerate('warning', 'Invalid Input');
        } else {
            return $this->alertGenerate('danger' , 'Unhandled Error');
        }
    }
}
