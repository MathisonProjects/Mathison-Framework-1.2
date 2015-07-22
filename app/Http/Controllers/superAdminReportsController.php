<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class superAdminReportsController extends Controller
{   
    public function index() {
        $keys  = array('View','Edit','Delete','Report Name','Description');
        $items = array();
        foreach ($this->menu['reports'] as $key => $item) {
            $array = array('<a href="/admin/super/reports/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                           '<a href="/admin/super/reports/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                           '<a href="/admin/super/reports/'.$item->id.'/delete">'.$this->vedIcon['Delete'].'</a>',
                           $item->name,
                           $item->description);
            array_push($items, $array);
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }
    public function create() {
        $objects = array('' => '');
        foreach ($this->menu['objects'] as $key => $object) {
            $objects[$object->id] = ucfirst($object->name);
        }
        return $this->launchView('create', array('objects' => $objects));
    }
    public function store(Request $request) {
        $this->module['reports']->processRequest($request);
    }
     
    public function show($id) {
        $keys       = array();
        $items      = array();
        $totals     = array();
        $trueTotal  = array();
        $report     = $this->module['reports']->where('id',$id)->first();
        $reportJson = json_decode($report->jsonreportparsing, true);
        $object     = $this->module['objects']->where('id',$reportJson['object'])->first();
        $dataset    = DB::table($this->db_prefix.$object->name);
        foreach ($reportJson['fields'] as $key => $field) {
            $field = $this->module['objects']->where('id',$field)->first();
            array_push($keys, $field->name);
        }
        foreach ($reportJson['filter'] as $key => $filter) {
            if (isset($filter['filtered']) && $filter['filtered'] == 'on') {
                $field = $this->module['objects']->where('id',$key)->first();
                if ($filter['operator'] == 'like') {
                    $filter['comparison'] = '%'.$filter['comparison'].'%';
                } 
                $dataset = $dataset->where($field->name, $filter['operator'], $filter['comparison']);
            }
        }
        $dataset = $dataset->orderBy('id')->get();

        foreach ($reportJson['totals'] as $key => $total) {
            if (isset($total['compute']) && $total['compute'] == 'on') {
                $field = $this->module['objects']->where('id',$key)->first();
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

        $table1 = $this->tableBuilder($keys,$items);
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

        $table2 = $this->tableBuilder($keys,$items);

        return $this->launchView('view', array('header' => $report->name, 'description' => $report->description, 'table1' => $table1, 'table2' => $table2));
    }
     
    public function edit($id) {
        //
    }
     
    public function update($id,Request $request) {
        //
    }
     
    public function destroy($id) {
        //
    }
}
