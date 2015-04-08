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
use DB;

class superAdminApiController extends Controller
{

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
    public function index() {
        $compact = array('apis' => $this->menu['apis']);
        return $this->launchView('views',$compact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $array = array('randString' => md5($this->generateRandomString(20)));
        return $this->launchView('create',$array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, mfwapis $mfwapis) {
        $mfwapis->insert([
            'randomid' => $request->get('randomid'),
            'action'   => $request->get('action'),
            'name'     => $request->get('name'),
            'fid'      => $request->get('fid'),
            'oid'      => $request->get('oid')]);
        return redirect('admin/super/api/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $api = array('api' => mfwapis::where('id', $id)->first());
        return $this->launchView('view',$api);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return $this->launchView('edit',array());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.api.'.$view,$compact);
    }

    private function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
