<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\CreditCard;
use PayPal\Api\BankAccount;


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
            $credentials[$items->id] = $items->client_id;
        }
        return $this->launchView('createPaymentProfile', array('credentials' => $credentials));
    }

    public function paymentProfileCreatePost(Request $request) {
        $paypal = $this->module['paypalkeys']->where('id', $request->input('cid'))->first();

        $apiContext = new ApiContext(new OAuthTokenCredential($paypal->client_id,$paypal->client_secret));
        if ($request->input('sandbox') == 1) {
            $apiContext->setConfig(array('mode' => 'sandbox'));
        }

        if ($request->input('card_number') != '') {
            $card = new CreditCard();
            $card->setType($request->input('cardType'))
                ->setNumber(str_replace('-', '', $request->input('card_number')))
                ->setExpireMonth($request->input('expiration_month'))
                ->setExpireYear($request->input('expiration_year'))
                ->setCvv2($request->input('ccv'))
                ->setFirstName($request->input('first_name'))
                ->setLastName($request->input('last_name'));
            $card->create($apiContext);
        } else {
            // TBD
        }

        $params = [];
        $params['owner']      = $request->input('first_name').' '.$request->input('last_name');
        $params['payment_id'] = $card->getId();
        $params['cid']        = $request->input('cid');
        if ($request->input('card_number') != '') {
            $params['last_four'] = 'XXXX'.substr($request->input('card_number'),-4);
        } else {
            $params['last_four'] = 'XXXX'.substr($request->input('accountNumber'),-4);
        }

        $this->module['paypalprofiles']->create($params);
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
