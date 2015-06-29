<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class superAdminObjectsController extends Controller {

	public function index() {
		$tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
		$keys = array('Object Name', 'Description', 'Delete');
		$items = array();
		foreach ($this->menu['objects'] as $key => $item) {
			array_push($items, array('<a href="/admin/super/viewObject/'.$item->name.'">'.$item->name.'</a>',$item->objectDescription,'<a href="/admin/super/objects/'.$item->id.'/delete"><i><span class="glyphicon glyphicon-remove"></span></i></a>'));
		}

		$table = $tableBuilder->setKeys($keys)->
					setValues($items)->
					buildTable();

		return $this->launchView('viewObjects', array('table' => $table));
	}

	public function create() {
		return $this->launchView('createObject', array());
	}

	public function store() {
		// NEEDS TWEAKING. NOT WORKING YET
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

	public function show($id) {
		//
	}

	public function edit($id) {
		//
	}

	public function update($id) {
		//
	}

	public function destroy($id) {
		$this->module['objects']->dropCustomTables($this->db_prefix,$id);
		return redirect('/admin/super/objects');
	}
}
