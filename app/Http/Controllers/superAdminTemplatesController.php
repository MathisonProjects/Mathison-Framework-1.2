<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use App\mfwmanageforms;
use App\mfwapis;
use App\mfwformprocessings;
use App\mfwtemplates;
use App\mfwpages;
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
        mfwtemplates::insert([
            'templatename' => $request->get('templatename'),
            'datatext'     => $request->get('datatext')]);
        return redirect('admin/super/template/');
    }

    public function show($id) {
        $template = array('template' => mfwtemplates::where('id', $id)->first());
        return $this->launchView('view',$template);
    }

    public function edit($id) {
        $templateData = mfwtemplates::where('id', $id)->first();
        return $this->launchView('edit', array('templateData' => $templateData));
    }

    public function update($id,Request $request) {
        $templates = mfwtemplates::where('id',$id)->first();
        $templates->fill($request->input())->save();
        return redirect('admin/super/template/'.$id);
    }

    public function destroy($id) {
        
    }

    public function templateFormat($id) {
        $template = mfwtemplates::where('id', $id)->first();
        $jsonData = array('template' => $template->datatext);
        return json_encode($jsonData);
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.templates.'.$view,$compact);
    }
}
