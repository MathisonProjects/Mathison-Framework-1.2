<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class superAdminApisController extends Controller
{

    public function index() {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'Random Id', 'Action', 'Name', 'Form Processing Id');
        $items = array();
        foreach ($this->menu['apis'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/apis/'.$item->id.'">'.$this->vedIcon['View'].'</a>','<a href="/admin/super/apis/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>','<a href="/admin/super/apis/'.$item->id.'/delete">'.$this->vedIcon['Delete'].'</a>',$item->id,$item->randomid,$item->action,$item->name,$item->fid));
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views',array('table' => $table));
    }

    public function create() {
        $array = array('randString' => md5($this->generateRandomString(20)));
        return $this->launchView('create',$array);
    }

    public function store(Request $request) {
        parent::save('create',$request);
    }

    public function show($id) {
        $api = array('api' => $this->module['apis']->where('id', $id)->first());
        return $this->launchView('view',$api);
    }

    public function edit($id) {
        return $this->launchView('edit',array());
    }

    public function update(request $request, $id) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }

    private function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
