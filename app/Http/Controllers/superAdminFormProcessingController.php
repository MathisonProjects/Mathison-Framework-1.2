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

class superAdminFormProcessingController extends Controller {

	public function index() {
        return $this->launchView('views',array());
	}

	public function create() {
        return $this->launchView('create',array());
	}

	public function store(Request $request)
	{
		$api    = mfwapis::where('randomid', $request->get('apiId'))->first();
		$object = mfwobjects::where('id', $api['oid'])->first();
		$input = array();
		foreach ($request->input() as $key => $value) {
			if ($key != '_token' && $key != 'apiId') {
				$input[$key] = $value;
			}
		}

		if ($api['action'] == 'create') {
			DB::table('mfwcus_'.$object['name'])->insert($input);
		} else if ($api['action'] == 'update') {
			DB::table('mfwcus_'.$object['name'])->where('id', $request->get('id'))->update($input);
		}

        return redirect('admin/super/viewObject/'.$object['name']);
	}

	public function show($id) {
        return $this->launchView('view',array());
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
        return view('superAdmin.formprocessing.'.$view,$compact);
    }
}
