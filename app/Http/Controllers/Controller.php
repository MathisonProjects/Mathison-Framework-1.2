<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Divinityfound\ArrayToBootstrapTable\Table as Table;

use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use App\mfwmanageforms;
use App\mfwapis;
use App\mfwformprocessings;
use App\mfwtemplates;
use App\mfwpages;
use App\mfwpdfs;
use App\mfwreports;
use App\mfwaccounts;
use DB;
use Session;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
    public $module, $menu, $post, $user, $workflow;
    public $db_prefix = 'mfwcus_';
    private $currentModule;

    public function __construct() {
        $this->loadModule();
        $this->loadMenu();
        $this->user = $this->module['accounts']->getAccount();
        $this->currentModule = lcfirst(str_replace('Controller', '', str_replace('App\Http\Controllers\superAdmin', '', get_class($this))));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->post = $_POST;
            $this->workflow['referrer'] = $_SERVER['HTTP_REFERER'];
            if (isset($_POST['destination'])) {
                $this->workflow['destination'] = $_POST['destination'];
            }
        } else {
            if ((!isset($this->user->sessionid) ||$this->user->accountlevel != 0) && $_SERVER["REQUEST_URI"] != '/admin/super') {
                $this->jsRedirect('/admin/super/');
            }
        }
    }

    public function __destruct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $workflow = $this->module['workflows']->setReferrer($this->workflow['referrer'])->checkWorkflowItem();
            if ($workflow->redirect == 1) {
                if ($workflow->finaldestination == '' || $workflow->default == 1) {
                    $this->jsRedirect($workflow->originaldestination);
                } else {
                    $this->jsRedirect($workflow->finaldestination);
                }
            }
        }
    }

    private function loadModule() {
        $this->module['objects']        = new mfwobjects;
        $this->module['forms']          = new mfwmanageforms;
        $this->module['workflows']      = new mfwworkflows;
        $this->module['relationships']  = new mfwobjectrelationships;
        $this->module['apis']           = new mfwapis;
        $this->module['formprocessing'] = new mfwformprocessings;
        $this->module['templates']      = new mfwtemplates;
        $this->module['pages']          = new mfwpages;
        $this->module['pdfs']           = new mfwpdfs;
        $this->module['reports']        = new mfwreports;
        $this->module['accounts']       = new mfwaccounts;
    }

    private function loadMenu() {
        foreach ($this->module as $key => $module) {
            if ($key == 'objects') {
                $this->menu[$key] = $module->where('oid', 0)->get();
            } else if ($key == 'forms') {
                $this->menu[$key] = $module->where('fid', 0)->get();
            } else {
                $this->menu[$key] = $module->get();
            }
        }
    }

    public function sanitizeName($field) {
        return str_replace(' ', '_', $field);
    }

    public function save($func, $request, $params = array()) {
        switch ($func) {
            case 'create':
                $this->module[$this->currentModule]->create($request->input());
                break;
            case 'update':
                $data = $this->module[$this->currentModule]->where('id',$params['id'])->first();
                $data->fill($request->input())->save();
                break;

            default:
                break;
        }
    }

    public function launchView($view,$compact) {
        $compact['menu'] = $this->menu;
        return view('superAdmin.'.$this->currentModule.'.'.$view,$compact);
    }

    public function jsRedirect($where) {
        die("<script>location.href = '".$where."'</script>");
    }

    public function tableBuilder($keys,$items) {
        $table = new Table();
        return $table->setKeys($keys)->
            setValues($items)->
            addClass('dataTableFormat')->
            buildTable();;
    }
}
