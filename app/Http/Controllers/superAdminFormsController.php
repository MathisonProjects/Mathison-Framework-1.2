<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminFormsController extends Controller
{
    public function index() {
        return $this->launchView('forms.views', array('formList' => $this->menu['forms']));
    }

    public function create() {
        return $this->launchView('forms.create', array());
    }

    public function store() {
        $this->module['forms']->createForm($this->post);
    }

    public function show($id) {
        $apiId = $this->module['apis']->where('fid', $id)->first()['randomid'];
        $this->module['forms']->viewForm($id);
        return $this->launchView('forms.view', array('formItem' => $forms->form, 'apiId' => $apiId));
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
        $apiId = $this->module['apis']->where('fid', $id)->first()['randomid'];
        $forms->viewForm($id);
        return $this->launchView('forms.formView', array('formItem' => $forms->form, 'apiId' => $apiId));
    }
}
