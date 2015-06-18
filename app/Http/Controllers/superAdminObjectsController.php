<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class superAdminObjectsController extends Controller {

	public function index() {
		return $this->launchView('objects.viewObjects', array());
	}

	public function create() {
		return $this->launchView('objects.createObject', array());
	}

	public function store() {
		//
	}

	public function show($id) {
		//
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
		return view('superAdmin.'.$view,$compact);
	}
}
