<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class pagesController extends Controller {

	public function __construct(){
		
	}

	public function index($custom_url) {
        $pageLayout = $this->module['pages']->where('stringurl', $custom_url)->first();
        if ($pageLayout['tid'] == 0) {
            $page     = array('page' => $pageLayout);
        } else {
            $template = $this->module['templates']->where('id', $pageLayout['tid'])->first();
            $sections = explode('@ENDSECTION',$pageLayout['datatext']);
            $regex = '/\@SECTION ([^)]+)\@/';
            $templateArray = array('datatext' => $template['datatext']);

            foreach ($sections as $key => $value) {
                if ($value != '') {
                    preg_match($regex, $value, $sectionName);
                    $value    = substr($value, strrpos($value, '@') + 1);
                    $partOne  = '@SECTION '.$sectionName[1].'@';
                    $newValue = str_replace($partOne, '', $value);
                    $templateArray['datatext'] = str_replace('[CONTENT='.$sectionName[1].']', $newValue, $templateArray['datatext']);
                }
            }
            $page = array('page' => $templateArray);
        }
		return view('page.view', $page);
	}
}
