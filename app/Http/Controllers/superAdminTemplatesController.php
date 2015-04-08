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

    public function __construct() {
        $this->menu['objects']        = mfwobjects::where('oid', 0)->get();
        $this->menu['workflows']      = mfwworkflows::get();
        $this->menu['relationships']  = mfwobjectrelationships::get();
        $this->menu['forms']          = mfwmanageforms::where('fid', 0)->get();
        $this->menu['apis']           = mfwapis::get();
        $this->menu['formprocessing'] = mfwformprocessings::get();
        $this->menu['templates']      = mfwtemplates::get();
        $this->menu['pages']          = mfwpages::get();
        if (isset($_POST)) {
            $this->post = $_POST;
        }
    }

    public function index() {
        return $this->launchView('views', array());
    }

    public function create() {
        return $this->launchView('create', array());
    }

    public function store(Request $request) {
        mfwtemplates::insert([
            'templatename' => $request->get('templatename'),
            'datatext'  => nl2br($request->get('datatextTemplate'))]);
        return redirect('admin/super/template/');
    }

    public function show($id) {
        $template = array('template' => mfwtemplates::where('id', $id)->first());
        return $this->launchView('view',$template);
    }

    public function edit($id) {
        
    }

    public function update($id) {
        
    }

    public function destroy($id) {
        
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.templates.'.$view,$compact);
    }
}
