<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $this->module['pages']->insert([
            'stringurl' => $request->get('stringurl'),
            'tid'       => $request->get('tid'),
            'datatext'  => $request->get('datatext')]);
        return redirect('admin/super/pages/');
    }

    public function show($id) {
        $pageLayout = $this->module['pages']->where('id', $id)->first();
        if ($pageLayout['tid'] == 0) {
            $page     = array('page' => $pageLayout);
        } else {
            $page = $this->templateMapping($pageLayout, $id);
        }
        return $this->launchView('view',$page);
    }

    public function edit($id) {
        $pageData = $this->module['pages']->where('id', $id)->first();

        $templates = array('' => '');
        foreach ($this->menu['templates'] as $template) {
            $templates[$template['id']] = $template['templatename'];
        }

        return $this->launchView('edit', array('pageData' => $pageData,'templates' => $templates));
    }

    public function update($id,Request $request) {
        $page = $this->module['pages']->where('id',$id)->first();
        $page->fill($request->input())->save();
        return redirect('admin/super/pages/'.$id);
    }

    public function destroy($id) {
    }

    private function formMapping() {

    }

    private function templateMapping($pageLayout, $id) {
        $template = $this->module['templates']->where('id', $pageLayout['tid'])->first();
        $sections = explode('@ENDSECTION',$pageLayout['datatext']);
        $sections = array_filter($sections);
        $regex = '/\@SECTION ([^)]+)\@/';
        $templateArray = array('datatext' => $template['datatext']);

        foreach ($sections as $key => $value) {
            preg_match($regex, $value, $sectionName);
            $sectionName[1] = substr($sectionName[1], strpos($sectionName[1], '@') + 1);
            $value = substr($value, strpos($value, '@') + 1);
            $partOne = 'SECTION '.$sectionName[1].'@';
            $newValue = str_replace($partOne, '', $value);
            echo '<pre>';
            print_r($sectionName[1]);
            echo '</pre>';
            exit;
            $templateArray['datatext'] = str_replace('[CONTENT='.$sectionName[1].']', $newValue, $templateArray['datatext']);
        }
        $templateArray['id'] = $id;
        return array('page' => $templateArray);
    }

    private function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.pages.'.$view,$compact);
    }
}
