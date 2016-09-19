<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mfwmanageforms;
use DB;

class superAdminFormsController extends Controller
{
    public function index() {
        return $this->launchView('views', array('formList' => $this->menu['forms']));
    }

    public function create() {
        return $this->launchView('create');
    }

    public function store(request $request) {
        $this->module['forms']->createForm($this->post);
    }

    public function show($id) {
        $apiId = $this->module['apis']->where('fid', $id)->first()['randomid'];
        $this->module['forms']->viewForm($id);
        return $this->launchView('view', array('formItem' => $this->module['forms']->form, 'apiId' => $apiId));
    }

    public function edit($id) {
        //
    }

    public function update(request $request) {
        //
    }

    public function destroy($id) {
        $this->deleteItem($this->module[$this->currentModule], $id);
        return $this->launchView('views');
    }

    public function formFormat(mfwmanageforms $forms, $id) {
        $apiId = $this->module['apis']->where('fid', $id)->first()['randomid'];
        $forms->viewForm($id);
        return $this->launchView('formView', array('formItem' => $forms->form, 'apiId' => $apiId));
    }
}
