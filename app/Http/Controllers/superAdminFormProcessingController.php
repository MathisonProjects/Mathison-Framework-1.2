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
use DB;

class superAdminFormProcessingController extends Controller {

	public function __construct() {
        $this->menu['objects']        = mfwobjects::where('oid', 0)->get();
        $this->menu['workflows']      = mfwworkflows::get();
        $this->menu['relationships']  = mfwobjectrelationships::get();
        $this->menu['forms']          = mfwmanageforms::where('fid', 0)->get();
        $this->menu['apis']           = mfwapis::get();
        $this->menu['formprocessing'] = mfwformprocessings::get();
        if (isset($_POST)) {
            $this->post = $_POST;
        }
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        return $this->launchView('views',array());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return $this->launchView('create',array());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return $this->launchView('view',array());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.formprocessing.'.$view,$compact);
    }
}
