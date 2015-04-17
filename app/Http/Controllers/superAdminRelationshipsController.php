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

class superAdminRelationshipsController extends Controller
{
    public function index() {
        return $this->launchView('viewRelationships', array());
    }

    public function create() {
        //
    }

    public function store() {
        //
    }

    public function show($id) {
        $relationship = mfwrelationships::where('id',$id)->first();
        $relationshipName = ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', ' $1', str_replace('_', ' ', $relationship->name)));
        return $this->launchView('viewRelationship', array('relationshipName' => $relationshipName, 'relationship' => $relationship));
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

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.relationships.'.$view,$compact);
    }
}
