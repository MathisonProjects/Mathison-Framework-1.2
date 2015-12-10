<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminAuthorizeNetController extends Controller
{
    public function apiKeyCreate() {
        return $this->launchView('createKey');
    }

    public function apiKeyCreatePost(Request $request) {
        $this->module['authorizekeys']->create($request->input());
    }

    public function apiKeyView() {
        $keys = array('Edit','Delete','API Login ID', 'Transaction Key');
        $items = array();
        foreach ($this->menu['authorizekeys'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/authorizenet/credentials/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/authorizenet/credentials/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->api_login_id,
                                     $item->transaction_key));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('viewKeys', array('table' => $table));
    }

    public function apiKeyDelete($id) {

    }

    public function paymentProfileCreate() {

    }

    public function paymentProfileCreatePost(Request $request) {
        $this->module['authorizeprofiles']->create($request->input());
    }

    public function paymentProfileDelete($id) {

    }

    public function paymentProfileView() {
        $keys = array('Edit','Delete','Owner', 'Authorize_Id', 'Last Four');
        $items = array();
        foreach ($this->menu['authorizeprofiles'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/authorizenet/credentials/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/authorizenet/credentials/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->owner,
                                     $item->authorize_id,
                                     $item->last_four));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('viewKeys', array('table' => $table));
    }

    public function paymentProcess() {

    }

    public function paymentProcessPost(Request $request) {

    }

    public function paymentsView() {

    }
}
