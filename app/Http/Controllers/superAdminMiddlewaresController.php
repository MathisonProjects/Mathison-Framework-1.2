<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminMiddlewaresController extends Controller {
    public function index() {
        $keys = array('View','Edit','Delete','randomid','name','targeturl');
        $items = array();
        foreach ($this->menu['middlewares'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/middlewares/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                                     '<a href="/admin/super/middlewares/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/middlewares/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->randomid,
                                     $item->name,
                                     $item->targeturl));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        return $this->launchView('create');
    }

    public function store() {
        parent::save('create',$request);
    }

    public function show($id) {
        return $this->launchView('view');
    }

    public function edit($id) {
        $data = $this->module['middlewares']->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data));
    }

    public function update($id, request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }
}
