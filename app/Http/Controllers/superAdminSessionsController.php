<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminSessionsController extends Controller {
    public function index() {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'Session');
        $items = array();
        foreach ($this->menu['sessions'] as $key => $items) {
            array_push($items, array(
                    '<a href="/admin/super/templates/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                    '<a href="/admin/super/templates/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                    '<a href="/admin/super/templates/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                    $item->id,
                    $item->name
                ));
        }

        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        return $this->launchView('create');
    }

    public function store(Request $request) {
        
    }

    public function show($id) {
        return $this->launchView('view');
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
