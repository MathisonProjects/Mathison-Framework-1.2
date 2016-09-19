<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminCraigslistFilterController extends Controller
{
    public function index() {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'Phrase');
        $items = array();
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            array_push($items, array(
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                    $item->id,
                    $item->phrase
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

    public function edit($id) {
        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data));
    }

    public function update($id, request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        $this->deleteItem($this->module[$this->currentModule], $id);
        return $this->launchView('views');
    }
}
