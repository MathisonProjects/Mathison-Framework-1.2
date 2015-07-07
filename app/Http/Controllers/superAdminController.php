<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mfwobjects;
use App\mfwworkflows;
use DB;

class SuperAdminController extends Controller {
	public function index() {
		if (isset($this->user->email) && $this->user->accountlevel == 0) {
			$menu = $this->menu;
			return view('superAdmin.index', compact('menu'));
		} else {
			$message = 'Set your Super Admin Account';
			$count = $this->module['accounts']->count();
			if ($count > 0) {
				$message = 'Use your Super Admin credentials';
			}

			return view('superAdmin.login', compact('message','count'));
		}
	}

	public function createAdmin(Request $request) {
		if ($this->module['accounts']->count() < 1) {
			$hash = md5(time());
			$this->module['accounts']->insert([array(
				'accountlevel' => 0,
				'email' => $request->input('email'),
				'password' => md5($request->input('password').$hash),
				'hash' => $hash,
				'active' => 1
			)]);
			$this->module['accounts']->login($request);
			return redirect()->back()->with('Login','Login Successful');
		}
	}

	public function adminLogin(Request $request) {
		$this->module['accounts']->login($request);
		if (session('sessionid') && $this->user->accountlevel == 0) {
			return redirect()->back()->with('Login','Login Successful');
		} else {
			return redirect()->back()->with('Logout','Login credentials incorrect');
		}
	}

	public function logout() {
		$this->module['accounts']->logout();
		return redirect('/admin/super/')->with('Logout', 'Logout Successful');
	}

	public function viewRecords(mfwobjects $object) {	
		$fields = $this->module['objects']->where('oid', $object->id)->orderBy('id')->get();
		$records = DB::table($this->db_prefix.$object->name)->get();
		$description = $object->objectDescription;
		$dbName = $object->name;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$menu = $this->menu;

		$tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
        $keys = array();
        foreach ($fields as $field) {
        	if ($field->name == 'id') {
        		array_push($keys,'View');
        		array_push($keys,'Edit');
        		array_push($keys,'Delete');
        	}
        	array_push($keys,$field->name);
        }
        $items = array();

        foreach ($records as $record) {
        	$data = array();
        	foreach ($fields as $field) {
        		$fname = $field->name;
	        	if ($fname == 'id') {
	        		array_push($data,"<a href='/admin/super/viewObject/".$dbName."/".$record->id."'><i><span class='glyphicon glyphicon-eye-open'></span></i></a>");
	        		array_push($data,"<a href='/admin/super/viewObject/".$dbName."/".$record->id."/edit'><i><span class='glyphicon glyphicon-edit'></span></i></a>");
	        		array_push($data,"<a href='#'><i><span class='glyphicon glyphicon-remove'></span></i></a>");
	        	}

	        	array_push($data, $record->$fname);
        	}
        	array_push($items,$data);
        }

        $table = $tableBuilder->setKeys($keys)->
            setValues($items)->
            buildTable();

		return view('superAdmin.objects.view', compact('objectName', 'dbName', 'records', 'description','fields','menu','table'));
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

	public function viewObjectItem(mfwobjects $object, $id) {
		// Relationship Builder
		$sharedDataArray = array();
		$allPrimaryRelationships       = $this->module['relationships']->where('tableone', $object->name)->get();
		$allSecondaryRelationships     = $this->module['relationships']->where('tabletwo', $object->name)->get();
		$sharedDataArray['primary']   = array();
		$sharedDataArray['secondary'] = array();
		// One to Many, A one, B many
		foreach ($allPrimaryRelationships as $primary) {
			$info['object'] = $primary->tabletwo;
			$info['data'] = DB::table($this->db_prefix.$primary->tableone.' as a')
								->join($this->db_prefix.$primary->tabletwo.' as b', 'a.'.$primary->fieldone, '=', 'b.'.$primary->fieldtwo)
								->where('a.id',$id)
								->get();
			
			array_push($sharedDataArray['primary'], $info);
		}

		foreach ($allSecondaryRelationships as $secondary) {
			$info['object'] = $secondary->tableone;
			$info['data'] = DB::table($this->db_prefix.$secondary->tabletwo.' as a')
								->join($this->db_prefix.$secondary->tableone.' as b', 'a.'.$secondary->fieldtwo, '=', 'b.'.$secondary->fieldone)
								->where('a.id',$id)
								->get();

			array_push($sharedDataArray['secondary'], $info);
		}
		// End Relationship Builder
		$sharedData = $sharedDataArray;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$record = DB::table($this->db_prefix.$object->name)->where('id', $id)->get();
		return $this->launchView('objects.viewObjectItem', compact('sharedData','objectName','record','object'));
	}

	public function viewObjectAddRecord(array $array) {
		$this->module['objects']->insertCustomData($this->db_prefix.$array[0],$array[1],$this->post);
	}
	public function editObjectItem(mfwobjects $object, $id) {
		$compact = array(
			'objectName' => ucwords(str_replace('_', ' ', $object->name)),
			'fields' => $this->module['objects']->where('oid', $object->id)->get(),
			'record' => DB::table($this->db_prefix.$object->name)->where('id', $id)->first(),
			'object' => $object);

		return $this->launchView('objects.editObjectItem', $compact);
	}

	public function editObjectItemPost(mfwobjects $object, $id)	{
		foreach ($this->post as $key => $value) {
			if ($key != 'id' && $key != 'objectName' && $key != '_token') {
				$update[$key] = $value;
			}
		}
		DB::table($this->db_prefix.$this->post['objectName'])
				->where('id', $this->post['id'])
				->update($update);
		
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

	public function uploads(Request $request) {
		$file = $request->file('file');
		$file->move('uploads', $file->getClientOriginalName());
	}
}