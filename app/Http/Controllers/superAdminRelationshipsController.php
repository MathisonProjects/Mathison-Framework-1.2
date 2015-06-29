<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminRelationshipsController extends Controller
{
    public function index() {
        return $this->launchView('views', array());
    }

    public function create() {
        return $this->launchView('create', array());
    }

    public function store(Request $request) {
        $this->post['relationshipname'] = $this->sanitizeName($this->post['relationshipname']);
        $this->module['relationships']->insert(['name' => $this->post['relationshipname'],
            'relationshiptype' => $this->post['relationshiptype'],
            'tableone' => $this->post['objectName'],
            'tabletwo' => $this->post['totable'],
            'fieldone' => $this->post['fromfield'],
            'fieldtwo' => $this->post['tofield']]);
    }

    public function show($id) {
        $relationship = $this->module['relationships']->where('id',$id)->first();
        $relationshipName = ucwords(preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', ' $1', str_replace('_', ' ', $relationship->name)));
        return $this->launchView('view', array('relationshipName' => $relationshipName, 'relationship' => $relationship));
    }

    public function edit($id) {
        $relationship = $this->module['relationships']->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $relationship));
    }

    public function update(request $request, $id) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }
}
