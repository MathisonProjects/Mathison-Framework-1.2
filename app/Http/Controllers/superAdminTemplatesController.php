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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return $this->launchView('create', array());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        return view('superAdmin.templates.'.$view,$compact);
    }
}
