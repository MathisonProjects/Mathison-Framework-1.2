<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminCronsController extends Controller {
    public function index() {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'Name', 'Description');
        $items = array();
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            array_push($items, array(
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                    $item->id,
                    $item->name,
                    $item->description
                ));
        }

        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        $objects = $this->loadObjects();
        return $this->launchView('create', array('objects' => $objects));
    }

    public function store(Request $request) {
        parent::save('create',$request);
    }

    public function show($id) {
        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        return $this->launchView('view', array('data' => $data));
    }

    public function edit($id) {
        $objects = $this->loadObjects();
        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data, 'objects' => $objects));
    }

    public function update($id, request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        $this->deleteItem($this->module[$this->currentModule], $id);
        return $this->launchView('views');
    }

    public function run() {

    }

    private function loadObjects() {
        $objects = array('' => '');
        foreach ($this->menu['objects'] as $key => $object) {
            $objects[$object->id] = ucfirst($object->name);
        }
        return $objects;
    }
}
