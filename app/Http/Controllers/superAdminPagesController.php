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

class superAdminPagesController extends Controller
{
    
    public function index() {
        return $this->launchView('views', array());
    }

    public function create() {
        $templates = array('' => '');
        foreach ($this->menu['templates'] as $template) {
            $templates[$template['id']] = $template['templatename'];
        }
        return $this->launchView('create', array('templates' => $templates));
    }

    public function store(Request $request) {
        mfwpages::insert([
            'stringurl' => $request->get('stringurl'),
            'tid'       => $request->get('tid'),
            'datatext'  => nl2br($request->get('datatext'))]);
        return redirect('admin/super/pages/');
    }

    public function show($id) {
        $pageLayout = mfwpages::where('id', $id)->first();
        if ($pageLayout['tid'] == 0) {
            $page     = array('page' => $pageLayout);
        } else {
            $template = mfwtemplates::where('id', $pageLayout['tid'])->first();
            $sections = explode('@ENDSECTION',$pageLayout['datatext']);
            $regex = '/\@SECTION ([^)]+)\@/';
            $templateArray = array('datatext' => $template['datatext']);

            foreach ($sections as $key => $value) {
                if ($value != '') {
                    preg_match($regex, $value, $sectionName);
                    $value = substr($value, strrpos($value, '@') + 1);
                    $partOne = '@SECTION '.$sectionName[1].'@\n';
                    $newValue = str_replace(array($partOne,'\n'), array('','<br />'), $value);
                    $templateArray['datatext'] = str_replace('[CONTENT='.$sectionName[1].']', $newValue, $templateArray['datatext']);
                }
            }
            $templateArray['id'] = $id;
            $page = array('page' => $templateArray);
        }
        return $this->launchView('view',$page);
    }

    public function edit($id) {
        $pageData = mfwpages::where('id', $id)->first();

        $templates = array('' => '');
        foreach ($this->menu['templates'] as $template) {
            $templates[$template['id']] = $template['templatename'];
        }

        return $this->launchView('edit', array('pageData' => $pageData,'templates' => $templates));
    }

    public function update($id,Request $request) {
        $page = mfwpages::where('id',$id)->first();
        $page->fill($request->input())->save();
        return redirect('admin/super/pages/'.$id);
    }

    public function destroy($id) {
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.pages.'.$view,$compact);
    }
}
