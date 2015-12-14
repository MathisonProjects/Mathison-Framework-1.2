<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminPaypalController extends Controller
{
    public function apiKeyCreate() {
        return $this->launchView('createKey');
    }

    public function apiKeyCreatePost(Request $request) {
        $this->module['paypalkeys']->create($request->input());
    }

    public function apiKeyView() {
        $keys = array('Edit','Delete','Client ID', 'Client Secret');
        $items = array();
        foreach ($this->menu['paypalkeys'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/paypal/credentials/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/paypal/credentials/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->client_id,
                                     $item->client_secret));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('viewKeys', array('table' => $table));
    }

    public function apiKeyDelete($id) {
        $this->module['paypalkeys']->destroy($id);
        return redirect()->back()->with('Alert', $this->messages(1));
    }

    public function paymentProfileCreate() {
        $paypalkeys = $this->module['paypalkeys']->get();
        $credentials = [''];
        foreach ($paypalkeys as $items) {
            $credentials[$items->id] = $items->api_login_id;
        }
        return $this->launchView('createPaymentProfile', array('credentials' => $credentials));
    }

    public function paymentProfileCreatePost(Request $request) {

    }

    public function paymentProfileDelete($id) {
        $this->module['paypalprofiles']->destroy($id);
        return redirect()->back()->with('Alert', $this->messages(2));
    }

    public function paymentProfileView() {
        $keys = array('Edit','Delete','Owner', 'Payment ID', 'Last Four');
        $items = array();
        foreach ($this->menu['paypalprofiles'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/authorizenet/credentials/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/authorizenet/credentials/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->owner,
                                     $item->payment_id,
                                     $item->last_four));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('viewPaymentProfiles', array('table' => $table));
    }

    public function paymentProcess() {
        $paypalkeys = $this->module['paypalprofiles']->get();
        $paymentProfiles = [''];
        foreach ($paypalkeys as $items) {
            $paymentProfiles[$items->id] = $items->owner.' - '.$items->last_four;
        }
        return $this->launchView('processPayment', array('paymentProfiles' => $paymentProfiles));
    }

    public function paymentProcessPost(Request $request) {
    }

    public function paymentsView() {

    }

    private function messages($id) {
        if ($id == 1) {
            return $this->alertGenerate('success', 'Key Deleted');
        } else if ($id == 2) {
            return $this->alertGenerate('success', 'Profile Deleted');
        } else {
            return $this->alertGenerate('danger' , 'Unhandled Error');
        }
    }
}
