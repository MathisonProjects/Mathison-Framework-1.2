<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class superAdminWorkflowsController extends Controller {

	public function index() {
		return $this->launchView('workflows.views', array());
	}

	public function create() {
		return $this->launchView('workflows.create', array());
	}

	public function store() {
		$this->module['workflows']->insert(['default' => $this->post['default'],
			'workflowitem' => $this->sanitizeName($this->post['workflowitem']),
			'originaldestination' => $this->post['originaldestination'],
			'finaldestination' => $this->post['finaldestination']]);
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
