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

class superAdminPdfController extends Controller
{

    public function __construct() {
        $this->menu['objects']       = mfwobjects::where('oid', 0)->get();
        $this->menu['workflows']     = mfwworkflows::get();
        $this->menu['relationships'] = mfwobjectrelationships::get();
        $this->menu['forms']         = mfwmanageforms::where('fid', 0)->get();
        $this->menu['apis']          = mfwapis::get();
        $this->menu['formprocessing'] = mfwformprocessings::get();
        if (isset($_POST)) {
            $this->post = $_POST;
        }
    }

    public function index()
    {
        PDF::SetTitle('Hello World');
        return 'Something went ok...';

        PDF::AddPage();

        PDF::Write(0, 'Hello World');

        PDF::Output('hello_world.pdf','FD');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        PDF::SetTitle('Hello World');

        PDF::AddPage();

        PDF::Write(0, 'Hello World');

        PDF::Output('hello_world.pdf');
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
}
