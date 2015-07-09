<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class superAdminFormProcessingController extends Controller {

	public function index() {
        return $this->launchView('views');
	}

	public function create() {
        return $this->launchView('create');
	}

	public function store(Request $request) {
		
	}

	public function show($id) {
        return $this->launchView('view');
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
}
