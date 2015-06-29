<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminTemplatesController extends Controller
{

    public function index() {
        return $this->launchView('views', array());
    }

    public function create() {
        return $this->launchView('create', array());
    }

    public function store(Request $request) {
        parent::save('templates','create',$request);
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
        parent::save('templates','update',$request, array('id' => $id));
    }

    public function destroy($id) {
        
    }

    public function templateFormat($id) {
        $template = $this->module['templates']->where('id', $id)->first();
        $jsonData = array('template' => $template->datatext);
        return json_encode($jsonData);
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.templates.'.$view,$compact);
    }
}
