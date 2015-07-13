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
            array_push($items, array('<a href="/admin/super/accounts/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/accounts/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->accountlevel,
                                     $item->email,
                                     $item->username,
                                     $item->active));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        return $this->launchView('create');
    }

    public function store() {
        parent::save('create',$request);
    }

    public function show($id) {
        return $this->launchView('view');
    }

    public function edit($id) {
        $data = $this->module['accounts']->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data));
    }

    public function update($id, request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        //
    }

    public function verify($hash) {
        $this->module['accounts']->verify($hash);
    }

    public function createAdmin(Request $request) {
        if ($this->module['accounts']->count() < 1) {
            $hash = md5(time());
            $inputArray = array(
                'accountlevel' => 0,
                'password' => md5($request->input('password').$hash),
                'hash' => $hash,
                'active' => 1);
            if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
                $inputArray['email'] = $request->input('email');
            } else {
                $inputArray['username'] = $request->input('email');
            }


            $this->module['accounts']->insert($inputArray);
            $this->module['accounts']->login($request);
            return redirect()->back()->with('Login','Login Successful');
        }
    }

    public function adminLogin(Request $request) {
        $this->module['accounts']->login($request);
        if (session('sessionid')) {
            $this->user = $this->module['accounts']->getAccount();
            if ($this->user->accountlevel == 0) {
                return redirect()->back()->with('Login','Login Successful');
            }
        }
        return redirect()->back()->with('Logout','Login credentials incorrect');
        
    }

    public function logout() {
        $this->module['accounts']->logout();
        return redirect('/admin/super/')->with('Logout', 'Logout Successful');
    }
}
