<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class superAdminPdfController extends Controller
{

    public function index() {
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::Write(0, 'Hello World');
        PDF::Output('hello_world.pdf','D');
        return 'PDF Generated';
    }

    public function create() {
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::Write(0, 'Hello World');
        PDF::Output('hello_world.pdf');
    }

    public function store() {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
