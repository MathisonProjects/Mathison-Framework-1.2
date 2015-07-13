<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mfwobjects;
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

	public function viewRecords(mfwobjects $object) {	
		$fields = $this->module['objects']->where('oid', $object->id)->orderBy('id')->get();
		$records = DB::table($this->db_prefix.$object->name)->get();
		$description = $object->objectDescription;
		$dbName = $object->name;
		$objectName = ucwords(str_replace('_', ' ', $object->name));
		$menu = $this->menu;

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
	        		array_push($data,"<a href='/admin/super/viewObject/".$dbName."/".$record->id."'>".$this->vedIcon['View']."</a>");
	        		array_push($data,"<a href='/admin/super/viewObject/".$dbName."/".$record->id."/edit'>".$this->vedIcon['Edit']."</a>");
	        		array_push($data,"<a href='#'>".$this->vedIcon['Delete']."</a>");
	        	}

	        	array_push($data, $record->$fname);
        	}
        	array_push($items,$data);
        }

        $table = $this->tableBuilder($keys,$items);

		return view('superAdmin.modules.objects.view', compact('objectName', 'dbName', 'records', 'description','fields','menu','table'));
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
		$menu = $this->menu;
		return view('superAdmin.modules.objects.viewObjectItem', compact('sharedData','objectName','record','object','menu'));
	}

	public function viewObjectAddRecord(array $array) {
		$this->module['objects']->insertCustomData($this->db_prefix.$array[0],$array[1],$this->post);
	}
	public function editObjectItem(mfwobjects $object, $id) {
		$compact = array(
			'objectName' => ucwords(str_replace('_', ' ', $object->name)),
			'fields' => $this->module['objects']->where('oid', $object->id)->get(),
			'record' => DB::table($this->db_prefix.$object->name)->where('id', $id)->first(),
			'object' => $object,
			'menu'   => $this->menu);

		return view('superAdmin.modules.objects.editObjectItem', $compact);
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