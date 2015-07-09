<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminAccountsController extends Controller {
    public function index() {
        $keys = array('Edit','Delete','Account Level', 'Email','Username','Active');
        $items = array();
        foreach ($this->menu['accounts'] as $key => $item) {
            array_push($items, array('<a href="#">'.$this->vedIcon['Edit'].'</a>','<a href="#">'.$this->vedIcon['Delete'].'</a>',$item->accountlevel,$item->email,$item->username,$item->active));
        }
        $table = $this->tableBuilder($keys,$items);

        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        //
    }

    public function store() {
        //
    }

    public function show($id) {
        return $this->launchView('view');
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
