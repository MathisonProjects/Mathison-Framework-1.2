<?php namespace App;

	use Illuminate\Database\Eloquent\Model as Eloquent;

	// Enables Schema Interaction
	use Illuminate\Database\Schema\Blueprint as Blueprint;
	use Illuminate\Support\Facades\Schema as Schema;
	use DB;
	use App\mfwobjects as mfwobjects;
	
	class mfwreports extends Eloquent {
	    protected $table = 'mfwreports';
		protected $fillable = ['name','description','jsonreportparsing'];

		public function processRequest($request) {
			$array = array(
					'object' => $request->input('object'),
					'fields' => $request->input('fields'),
					'filter' => $request->input('filter'),
					'totals' => $request->input('totals')
				);

			self::insert(['name' 		=> $request->input('name'),
						  'description' => $request->input('description'),
						  'jsonreportparsing' => json_encode($array)]);
		}

		public function generateReport($id) {
	        $keys       = array();
	        $items      = array();
	        $totals     = array();
	        $trueTotal  = array();
			$report     = self::where('id',$id)->first();
        	$reportJson = json_decode($report->jsonreportparsing, true);
        	$object     = mfwobjects::where('id',$reportJson['object'])->first();
        	$dataset    = DB::table('mfwcus_'.$object->name);
        	foreach ($reportJson['fields'] as $key => $field) {
	            $field = mfwobjects::where('id',$field)->first();
	            array_push($keys, $field->name);
	        }
        	foreach ($reportJson['filter'] as $key => $filter) {
            	if (isset($filter['filtered']) && $filter['filtered'] == 'on') {
                	$field = mfwobjects::where('id',$key)->first();
                	if ($filter['operator'] == 'like') {
                    	$filter['comparison'] = '%'.$filter['comparison'].'%';
                	} 
                	$dataset = $dataset->where($field->name, $filter['operator'], $filter['comparison']);
	            }
	        }

        	$dataset = $dataset->orderBy('id')->get();

        	foreach ($reportJson['totals'] as $key => $total) {
	            if (isset($total['compute']) && $total['compute'] == 'on') {
	                $field = mfwobjects::where('id',$key)->first();
	                $totals[$field->name]['total'] = 0;
	                $totals[$field->name]['operation'] = $total['operation'];
	                $totals[$field->name]['count'] = 0;
	            }
	        }

	        foreach ($dataset as $key => $data) {
	            $array = array();
	            foreach ($keys as $i => $field) {
	                array_push($array, $data->$field);
	            }
	            foreach ($totals as $i => $total) {
	                $totals[$i]['total'] += $data->$i;
	                $totals[$i]['count']++;
	            }

	            array_push($items, $array);
	        }

	        $set1 = $this->tableFormat($keys, $items);

	        $keys = array();
	        $items = array();
	        foreach ($totals as $key => $total) {
	            array_push($keys, $key.' - '.ucfirst($total['operation']));
	            if ($total['operation'] == 'sum') {
	                array_push($items, array($total['total']));
	            } else if ($total['operation'] == 'average') {
	                array_push($items, array($total['total']/$total['count']));
	            }
	        }

	        $set2 = $this->tableFormat($keys, $items);

	        return array($set1, $set2);
		}

		public function tableFormat($keys,$items) {
			$table = '<table border="1" cellpadding="3"><tr>';

			foreach ($keys as $key => $value) {
				$table .= '<td>'.ucfirst($value).'</td>';
			}

			$table .= '</tr>';

			foreach ($items as $key => $item) {
				$table .= '<tr>';
				foreach ($item as $field) {
					$table .= '<td>'.$field.'</td>';
				}
				$table .= '</tr>';
			}

			$table .= '</table>';
			return $table;
		}
	}
?>