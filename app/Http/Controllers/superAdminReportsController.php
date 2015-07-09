<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        //
    }
    public function store() {
        //
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
}
