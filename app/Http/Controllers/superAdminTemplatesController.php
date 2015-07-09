<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminTemplatesController extends Controller
{

    public function index() {
        $keys = array('View','Edit','Delete','Id','Template Name');
        $items = array();
        foreach ($this->menu['templates'] as $key => $item) {
            array($items, array(
                    '<a href="/admin/super/templates/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                    '<a href="/admin/super/templates/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                    '<a href="/admin/super/templates/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                    $item->id,
                    $item->templatename
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
        $template = array('template' => $this->module['templates']->where('id', $id)->first());
        return $this->launchView('view',$template);
    }

    public function edit($id) {
        $templateData = $this->module['templates']->where('id', $id)->first();
        return $this->launchView('edit', array('templateData' => $templateData));
    }

    public function update($id,Request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        
    }

    public function templateFormat($id) {
        $template = $this->module['templates']->where('id', $id)->first();
        $jsonData = array('template' => $template->datatext);
        return json_encode($jsonData);
    }
}
