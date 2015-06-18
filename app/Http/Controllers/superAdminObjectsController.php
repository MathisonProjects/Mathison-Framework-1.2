<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class superAdminObjectsController extends Controller {

	public function index() {
		$tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
		$keys = array('Object Name', 'Description');
		$items = array();
		foreach ($this->menu['objects'] as $key => $item) {
			array_push($items, array($item->name,$item->objectDescription));
		}

		$table = $tableBuilder->setKeys($keys)->
					setValues($items)->
					buildTable();
					
		return $this->launchView('objects.viewObjects', array('table' => $table));
	}

	public function create() {
		return $this->launchView('objects.createObject', array());
	}

	public function store() {
		// NEEDS TWEAKING. NOT WORKING YET
		$this->module['objects']->insert(['name' => $this->sanitizeName($this->post['objectName']),
			'objectDescription' => $this->post['objectDescription']]);
		$data = $this->module['objects']->where('name',$this->sanitizeName($this->post['objectName']))->first();
		$id = $data->id;

		for ($i = 1; $i <= $this->post['totalFields']; $i++) {
			$this->module['objects']->insert(['oid' => $id,
				'name' => $this->sanitizeName($this->post['objectItemFieldName'.$i]),
				'datatype' => $this->post['objectItemDataType'.$i],
				'dataquantity' => $this->post['objectItemQuantity'.$i]]);
		}

		return redirect($redirect);
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
		//
	}

	private function launchView($view,$compact) {
		$compact['menu'] = $this->menu;
		return view('superAdmin.'.$view,$compact);
	}
}
