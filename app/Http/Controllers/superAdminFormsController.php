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

class superAdminFormsController extends Controller
{
    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        //
    }

    public function show($id) {
        //
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

    public function formFormat(mfwmanageforms $forms, $id) {
        $apiId = mfwapis::where('fid', $id)->first()['randomid'];
        $forms->viewForm($id);
        return $this->launchView('forms.formView', array('formItem' => $forms->form, 'apiId' => $apiId));
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.'.$view,$compact);
    }
}
