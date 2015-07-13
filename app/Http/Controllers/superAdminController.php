<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SuperAdminController extends Controller {
	public function index() {
		if (isset($this->user->email) && $this->user->accountlevel == 0) {
			$menu = $this->menu;
			return view('superAdmin.index', compact('menu'));
		} else {
			$message = 'Set your Super Admin Account';
			$count = $this->module['accounts']->count();
			if ($count > 0) {
				$message = 'Use your Super Admin credentials';
			}

			return view('superAdmin.login', compact('message','count'));
		}
	}

	public function uploads(Request $request) {
		$file = $request->file('file');
		$file->move('uploads', $file->getClientOriginalName());
	}
}