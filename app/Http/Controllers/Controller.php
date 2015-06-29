<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use App\mfwmanageforms;
use App\mfwapis;
use App\mfwformprocessings;
use App\mfwtemplates;
use App\mfwpages;
use App\mfwpdfs;
use DB;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
    public $module;
	public $menu;
	public $post;
    public $db_prefix = 'mfwcus_';
    public $workflow;

    public function __construct() {
        $this->loadModule();
        $this->loadMenu();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->post = $_POST;
            $this->workflow['referrer'] = $_SERVER['HTTP_REFERER'];
            if (isset($_POST['destination'])) {
                $this->workflow['destination'] = $_POST['destination'];
            }
        }
    }

    public function __destruct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $workflow = $this->module['workflows']->setReferrer($this->workflow['referrer'])->checkWorkflowItem();

            if ($workflow->finaldestination == '' || $workflow->default == 1) {
                die("<script>location.href = '".$workflow->originaldestination."'</script>");
            } else {
                die("<script>location.href = '".$workflow->finaldestination."'</script>");
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

    public function save($module, $func, $request, $params = array()) {
        switch ($func) {
            case 'create':
                $this->module[$module]->create($request->input());
                break;
            case 'update':
                $data = $this->module[$module]->where('id',$params['id'])->first();
                $data->fill($request->input())->save();
                break;

            default:
                break;
        }
    }
}
