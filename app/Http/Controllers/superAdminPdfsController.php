<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class superAdminPdfsController extends Controller {

    public function index() {
        $keys  = array('Download', 'View','Edit','Delete','PDF Name','Description');
        $items = array();
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            $array = array('<a href="/admin/super/pdfs/'.$item->id.'/download">'.$this->vedIcon["Download"].'</a>',
                           '<a href="/admin/super/pdfs/'.$item->id.'">'.$this->vedIcon["View"].'</a>',
                           '<a href="/admin/super/pdfs/'.$item->id.'/edit">'.$this->vedIcon["Edit"].'</a>',
                           '<a href="/admin/super/pdfs/'.$item->id.'/delete">'.$this->vedIcon["Delete"].'</a>',
                           $item->name,
                           $item->description);
            array_push($items, $array);
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        $dbreports = $this->module['reports']->get();
        $reports = array('');
        foreach ($dbreports as $key => $report) {
            $reports[$report->id] = ucfirst($report->name);
        }
        return $this->launchView('create', array('reports' => $reports));
    }

    public function store(request $request) {
        parent::save('create',$request);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $pdf = $this->module[$this->currentModule]->where('id', $id)->first();
        $dbreports = $this->module['reports']->get();
        $reports = array('');
        foreach ($dbreports as $key => $report) {
            $reports[$report->id] = ucfirst($report->name);
        }
        return $this->launchView('edit', array('data' => $pdf,'reports' => $reports));
    }

    public function update($id,request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }

    public function download($id) {
        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        $report = $this->module['reports']->generateReport($data->id);
        $this->module['pdfs']->createPdf($data,$report);
        return 'PDF Generated';
    }
}
