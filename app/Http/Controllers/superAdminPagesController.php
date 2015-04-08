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

class superAdminPagesController extends Controller
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
        $templates = array('' => '');
        foreach ($this->menu['templates'] as $template) {
            $templates[$template['id']] = $template['templatename'];
        }
        return $this->launchView('create', array('templates' => $templates));
    }

    public function store(Request $request) {
        mfwpages::insert([
            'stringurl' => $request->get('stringurl'),
            'tid'       => $request->get('tid'),
            'datatext'  => nl2br($request->get('datatext'))]);
        return redirect('admin/super/pages/');
    }

    public function show($id) {
        $page = array('page' => mfwpages::where('id', $id)->first());
        return $this->launchView('view',$page);
    }

    public function edit($id) {
        $id = array('id' => mfwpages::where('id', $id)->first());
        return $this->launchView('edit', array());
    }

    public function update($id,Request $request) {
    }

    public function destroy($id) {
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.pages.'.$view,$compact);
    }
}
