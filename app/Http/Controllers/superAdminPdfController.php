<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class superAdminPdfController extends Controller {

    public function index() {
        $tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
        $keys  = array('View','Edit','Delete','PDF Name','Description');
        $items = array();
        foreach ($this->menu['pdfs'] as $key => $item) {
            $array = array('<a href="/admin/super/pdfs/'.$item->id.'"><i><span class="glyphicon glyphicon-eye-open"></span></i></a>' , '<a href="/admin/super/pdfs/'.$item->id.'/edit"><i><span class="glyphicon glyphicon-edit"></span></i></a>', '<a href="/admin/super/pdfs/'.$item->id.'/delete"><i><span class="glyphicon glyphicon-remove"></span></i></a>', $item->name , $item->description);
            array_push($items, $array);
        }
        $table = $tableBuilder->setKeys($keys)->
            setValues($items)->
            buildTable();
        return $this->launchView('pdfs.views', array('table' => $table));
    }

    public function create() {
        return $this->launchView('pdfs.create', array());
    }

    public function store(request $request) {
        parent::save('pdfs','create',$request);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $pdf = $this->module['pdfs']->where('id', $id)->first();
        return $this->launchView('pdfs.edit', array('pdfData' => $pdf));
    }

    public function update($id,request $request) {
        parent::save('pdfs','update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.'.$view,$compact);
    }
}
