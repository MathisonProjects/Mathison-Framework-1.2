<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel as Excel;

class superAdminObjectsController extends Controller {
	static $miscData = array();

	public function index() {
		$keys = array('Object Name', 'Description', 'Total Records', 'Delete');
		$items = array();
		foreach ($this->menu['objects'] as $key => $item) {
			array_push($items, array('<a href="/admin/super/viewObject/'.$item->name.'">'.$item->name.'</a>',$item->objectDescription,DB::table($this->db_prefix.$item->name)->count(),'<a href="/admin/super/objects/'.$item->id.'/delete"><i><span class="glyphicon glyphicon-remove"></span></i></a>'));
		}
        $table = $this->tableBuilder($keys,$items);

		return $this->launchView('viewObjects', array('table' => $table));
	}

	public function create() {
		return $this->launchView('createObject');
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

	public function import($id, Request $request) {
		$object = $this->module['objects']->where('id', $id)->first();
		self::$miscData['objectName'] = $this->db_prefix.$object->name;
		self::$miscData['fields'] = $this->module['objects']->where('oid', $id)->get();
		$file = $request->file('file');

		Excel::load($file, function($reader) {
            $i = 0;
            $results = $reader->get();

            foreach ($results as $row) {
            	$array = array();
            	foreach (self::$miscData['fields'] as $field) {
            		$fname = $field->name;
            		if ($fname != 'id') {
            			$array[$fname] = $row->$fname;
            		}
            	}
                DB::table(self::$miscData['objectName'])->insert($array);
                $i++;
                echo $i.': ROW PROCESSED<br />';
            }
        });
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
}
