<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminAccountsController extends Controller {
    public function index() {
        $tableBuilder = new \Divinityfound\ArrayToBootstrapTable\Table();
        $keys = array('Edit','Delete','Account Level', 'Email','Username','Active');
        $items = array();
        foreach ($this->menu['accounts'] as $key => $item) {
            array_push($items, array('E','D',$item->accountlevel,$item->email,$item->username,$item->active));
        }
        $table = $tableBuilder->setKeys($keys)->
            setValues($items)->
            buildTable();

        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        //
    }

    public function store() {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update($id) {
        //
    }

    public function destroy($id) {
        //
    }

    public function verify($hash) {
        $this->module['accounts']->verify($hash);
    }
}
