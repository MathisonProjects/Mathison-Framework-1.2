<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminTemplatesController extends Controller
{

    public function index() {
        return $this->launchView('templates.views', array());
    }

    public function create() {
        return $this->launchView('templates.create', array());
    }

    public function store(Request $request) {
        parent::save('create',$request);
    }

    public function show($id) {
        $template = array('template' => $this->module['templates']->where('id', $id)->first());
        return $this->launchView('templates.view',$template);
    }

    public function edit($id) {
        $templateData = $this->module['templates']->where('id', $id)->first();
        return $this->launchView('templates.edit', array('templateData' => $templateData));
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
