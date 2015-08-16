<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel as Excel;
use App\mfwobjects;

class superAdminObjectsController extends Controller {
	static $miscData = array();

	public function index() {
		$keys = array('Object Name', 'Description', 'Total Records', 'Edit Name', 'Edit Columns', 'Delete');
		$items = array();
		foreach ($this->menu['objects'] as $key => $item) {
			array_push($items, array('<a href="/admin/super/objects/'.$item->name.'">'.$item->name.'</a>',$item->objectDescription,DB::table($this->db_prefix.$item->name)->count(),'<a href="/admin/super/objects/'.$item->id.'/rename">'.$this->vedIcon['Edit'].'</a>', '<a href="/admin/super/objects/'.$item->id.'/editColumns">'.$this->vedIcon['Settings'].'</a>' ,'<a href="/admin/super/objects/'.$item->id.'/delete">'.$this->vedIcon['Delete'].'</a>'));
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

	public function rename($id) {
		$object = $this->module['objects']->where('id', $id)->first();
		return $this->launchView('renameTable', array('object' => $object));
	}

	public function renamePost($id, request $request) {
		$this->module['objects']->renameTable($this->db_prefix, $id, $request->input('newName'));
	}

	public function editColumns($id) {
		$object = $this->module['objects']->where('oid', $id)->get();
		return $this->launchView('editColumns', array('object' => $object));
	}

	public function editColumnsPost($id,request $request) {
		foreach ($request->input() as $key => $value) {
			if ($key != '_token') {
				$this->module['objects']->editColumn($this->db_prefix, $id, $key, $value);
			}
		}
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
				'name'         => $this->sanitizeName($this->post['object']['name'][$i]),
				'datatype' 	   => $this->post['object']['data'][$i],
				'dataquantity' => $this->post['object']['quantity'][$i],
				'defaultval'   => $this->post['object']['default'][$i]]);
		}

		$fields = $this->module['objects']->where('oid', $id)->get();
		$this->module['objects']->createTable($this->db_prefix.$this->post['objectName'], $fields);
	}

	public function viewRecords(mfwobjects $object) {	
		$fields = $this->module['objects']->where('oid', $object->id)->orderBy('id')->get();
		$records = DB::table($this->db_prefix.$object->name)->get();
		$description = $object->objectDescription;
		$dbName = $object->name;
		$objectName = ucwords(str_replace('_', ' ', $object->name));

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
	        		array_push($data,"<a href='/admin/super/objects/".$dbName."/".$record->id."'>".$this->vedIcon['View']."</a>");
	        		array_push($data,"<a href='/admin/super/objects/".$dbName."/".$record->id."/edit'>".$this->vedIcon['Edit']."</a>");
	        		array_push($data,"<a href='#'>".$this->vedIcon['Delete']."</a>");
	        	}

	        	array_push($data, $record->$fname);
        	}
        	array_push($items,$data);
        }

        $table = $this->tableBuilder($keys,$items);

		return $this->launchView('view', compact('objectName', 'dbName', 'records', 'description','fields','table'));
	}

	public function viewObjectItem(mfwobjects $object, $id) {
		// Relationship Builder
		$sharedDataArray = array();
		$allPrimaryRelationships      = $this->module['relationships']->where('tableone', $object->name)->get();
		$allSecondaryRelationships    = $this->module['relationships']->where('tabletwo', $object->name)->get();
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
		return $this->launchView('viewObjectItem', compact('sharedData','objectName','record','object'));
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

		return $this->launchView('editObjectItem', $compact);
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

	public function getFields($id) {
		$fields = $this->module['objects']->where('oid', $id)->get();
		$returnFields = array();
		foreach ($fields as $key => $field) {
			$returnFields[$field->id] = ucfirst($field->name);
		}
		return json_encode($returnFields);
	}

	public function sortDisplay() {
        $objects = array('' => '');
        foreach ($this->menu['objects'] as $key => $object) {
            $objects[$object->id] = ucfirst($object->name);
        }

		return $this->launchView('sortObjects1', array('objects' => $objects));
	}

	public function postSortDisplay(request $request) {
		if ($request->input('page') == '1') {
			$keys = array('Use Record');
			$fields = array();

			foreach ($request->input('fields') as $key => $field) {
				$data = $this->module['objects']->where('id', $field)->first();
				array_push($fields, $data->name);
				array_push($keys, ucwords(str_replace('_', ' ', $data->name)));
			}

			$objectData = $this->getObjectData($request->input('object'));
			$items = array();
			
			foreach ($objectData as $key => $item) {
				$array = array('<input type="checkbox" name="value['.$item->id.']" value="'.$item->id.'" class="form-control" />');
				foreach ($fields as $key2 => $field) {
					array_push($array, $item->$field);
				}
				array_push($items, $array);
			}

        	$table = $this->tableBuilderTwo($keys,$items);

        	$calculated = array();

        	foreach ($request->input('calculated') as $key => $field) {
				$data = $this->module['objects']->where('id', $field)->first();
				array_push($calculated, $data->name);
			}

			return $this->launchView('sortObjects2', array('table' => $table, 'calculated' => $calculated, 'oid' => $request->input('object')));
		} else if ($request->input('page') == '2') {
			$object = $this->module['objects']->where('id', $request->input('oid'))->first();
			$combinations = array();
			$allData = array();
			$loop = true;

			foreach ($request->input('value') as $key => $value) {
				array_push($allData, DB::table($this->db_prefix.$object->name)->where('id', $value)->first());
			}

			$combinations = $this->pc_array_power_set($allData,$request->input('groupsof'));

			foreach ($request->input('rule') as $key => $parser) {
				$combinations = $this->sanitizeSortList($combinations,$request->input('groupsof'),$parser['variable'], $key, $parser['amount']);
			}
				echo "<pre>";
				print_r($combinations);
				echo "</pre>";
				exit();
		}
	}

	private function pc_array_power_set($array,$quantity_desired) {
	    // initialize by adding the empty set
	    $results = array(array( ));

	    foreach ($array as $element) {
	        foreach ($results as $combination) {
	            array_push($results, array_merge(array($element), $combination));
	        }
	    }
	    $true_results = array();
	    foreach ($results as $key => $array) {
	    	if (count($array) == $quantity_desired) {
	    		array_push($true_results, $array);
	    	}
	    }

	    return $true_results;
	}

	private function sanitizeSortList($array, $quantity, $comparison, $field, $limit) {
		$final_array = array();
		foreach ($array as $key => $value) {
			$amount = 0;
			foreach ($value as $to_be_calculated) {
				$amount += $to_be_calculated->$field;
			}

			switch ($comparison) {
				case '>':
					if ($amount > $limit) {
						array_push($final_array, $value);
					}
					break;

				case '>=':
					if ($amount >= $limit) {
						array_push($final_array, $value);
					}
					break;

				case '==':
					if ($amount == $limit) {
						array_push($final_array, $value);
					}
					break;

				case '<=':
					if ($amount <= $limit) {
						array_push($final_array, $value);
					}
					break;

				case '<':
					if ($amount < $limit) {
						array_push($final_array, $value);
					}
					break;

				case 'A':
					if ($amount/$quantity == $limit) {
						array_push($final_array, $value);
					}
					break;
				
				default:
					break;
			}
		}
		return $final_array;
	}

	public function getObjectData($objectId) {
		$object = $this->module['objects']->where('id', $objectId)->first();
		return DB::table($this->db_prefix.$object->name)->orderBy('id')->get();
	}
}
