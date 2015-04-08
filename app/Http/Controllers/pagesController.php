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

class pagesController extends Controller {

	public function __construct(){
		
	}

	public function index($custom_url) {
        $page = array('page' => mfwpages::where('stringurl', $custom_url)->first());
		return view('page.view', $page);
	}

}
