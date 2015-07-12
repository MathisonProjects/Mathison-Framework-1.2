<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminConstantsController extends Controller {
    public function index() {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'Constant', 'Value');
        $items = array();
        foreach ($this->menu['constants'] as $key => $item) {
            array_push($items, array(
                    '<a href="/admin/super/constants/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                    '<a href="/admin/super/constants/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                    '<a href="/admin/super/constants/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                    $item->id,
                    $item->name,
                    $item->value
                ));
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        return $this->launchView('create');
    }

    public function store(Request $request) {
        parent::save('create',$request);
    }

    public function show($id) {
        return $this->launchView('view');
    }

    public function edit($id, request $request) {
        $data = $this->module['constants']->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data));
    }

    public function update($id) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }
}
