<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class superAdminPagesController extends Controller
{
    
    public function index() {
        $keys  = array('View','Edit','Delete','Id','String URL','Template ID');
        $items = array();
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            array_push($items, array("<a href='/admin/super/pages/".$item->id."'>".$this->vedIcon['View']."</a>","<a href='/admin/super/pages/".$item->id."/edit'>".$this->vedIcon['Edit']."</a>","<a href='/admin/super/pages/".$item->id."/delete'>".$this->vedIcon['Delete']."</a>",$item->id,$item->stringurl,$item->tid));
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        $templates = array('' => '');
        foreach ($this->menu['templates'] as $template) {
            $templates[$template['id']] = $template['templatename'];
        }
        return $this->launchView('create', array('templates' => $templates));
    }

    public function store(Request $request) {
        parent::save('create',$request);
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
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        $this->deleteItem($this->module[$this->currentModule], $id);
        return $this->launchView('views');
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
}
