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
        $this->module['authorizekeys']->destroy($id);
        return redirect()->back()->with('Alert', $this->messages(1));
    }

    public function paymentProfileCreate() {
        $authorizekeys = $this->module['authorizekeys']->get();
        $credentials = [''];
        foreach ($authorizekeys as $items) {
            $credentials[$items->id] = $items->api_login_id;
        }
        return $this->launchView('createPaymentProfile', array('credentials' => $credentials));
    }

    public function paymentProfileCreatePost(Request $request) {

        if (!defined('AUTHORIZENET_API_LOGIN_ID')) {
            $authorize = $this->module['authorizekeys']->where('id', $request->input('cid'))->first();
            define("AUTHORIZENET_API_LOGIN_ID", $authorize->api_login_id);
            define("AUTHORIZENET_TRANSACTION_KEY", $authorize->transaction_key);
            if ($authorize->sandbox == 1) {
                define("AUTHORIZENET_SANDBOX", true);
            } else {
                define("AUTHORIZENET_SANDBOX", false);
            }
        }

        // Create new customer profile
        $authorize_cim                                       = new \AuthorizeNetCIM;
        $customerProfile                                     = new \AuthorizeNetCustomer;
        $customerProfile->description                        = "MFW Authorize.Net Customer";
        $customerProfile->merchantCustomerId                 = time().rand(1,100);
        $customerProfile->email                              = $request->input('address_email');

        // Add payment profile.
        $paymentProfile                                      = new \AuthorizeNetPaymentProfile;
        if ($request->input('card_number') != '') {
            $paymentProfile->customerType                        = "individual";
            $paymentProfile->payment->creditCard->cardNumber     = str_replace('-', '', $request->input('card_number'));
            $paymentProfile->payment->creditCard->expirationDate = $request->input('expiration_year').'-'.$request->input('expiration_month');
            
        } else {
            $paymentProfile->customerType                        = "business";
            $paymentProfile->payment->bankAccount->accountType   = $request->input('accountType');
            $paymentProfile->payment->bankAccount->routingNumber = $request->input('routingNumber');
            $paymentProfile->payment->bankAccount->accountNumber = $request->input('accountNumber');
            $paymentProfile->payment->bankAccount->nameOnAccount = $request->input('first_name').' '.$request->input('last_name');
            $paymentProfile->payment->bankAccount->echeckType    = "WEB";
            $paymentProfile->payment->bankAccount->bankName      = $request->input('bankName');
            
        }


        $paymentProfile->payment->creditCard->cardCode       = $request->input('ccv');
        $paymentProfile->billTo->firstName                   = $request->input('first_name');
        $paymentProfile->billTo->lastName                    = $request->input('last_name');
        $paymentProfile->billTo->address                     = $request->input('address_street');
        $paymentProfile->billTo->city                        = $request->input('address_city');
        $paymentProfile->billTo->state                       = $request->input('address_state');
        $paymentProfile->billTo->zip                         = $request->input('address_zip');
        $paymentProfile->billTo->phoneNumber                 = $request->input('address_phone');
        $customerProfile->paymentProfiles[]                  = $paymentProfile;

        $response                                            = $authorize_cim->createCustomerProfile($customerProfile);
        $ids = [];
        $ids['customer'] = (array)$response->xml->customerProfileId;
        $ids['cc']       = (array)$response->xml->customerPaymentProfileIdList->numericString;

        $params = [];
        $params['owner']                 = $request->input('first_name').' '.$request->input('last_name');
        $params['authorize_id_customer'] = $ids['customer'][0];
        $params['authorize_id_cc']       = $ids['cc'][0];
        $params['cid']                   = $request->input('cid');
        if ($request->input('card_number') != '') {
            $params['last_four'] = 'XXXX'.substr($request->input('card_number'),-4);
        } else {
            $params['last_four'] = 'XXXX'.substr($request->input('accountNumber'),-4);
        }

        $this->module['authorizeprofiles']->create($params);
    }

    public function paymentProfileDelete($id) {
        $this->module['authorizeprofiles']->destroy($id);
        return redirect()->back()->with('Alert', $this->messages(2));
    }

    public function paymentProfileView() {
        $keys = array('Edit','Delete','Owner', 'Customer ID', 'Payment ID', 'Last Four');
        $items = array();
        foreach ($this->menu['authorizeprofiles'] as $key => $item) {
            array_push($items, array('<a href="/admin/super/authorizenet/credentials/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                     '<a href="/admin/super/authorizenet/credentials/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                                     $item->owner,
                                     $item->authorize_id_customer,
                                     $item->authorize_id_cc,
                                     $item->last_four));
        }
        $table = $this->tableBuilder($keys, $items);

        return $this->launchView('viewPaymentProfiles', array('table' => $table));
    }

    public function paymentProcess() {
        $authorizekeys = $this->module['authorizeprofiles']->get();
        $paymentProfiles = [''];
        foreach ($authorizekeys as $items) {
            $paymentProfiles[$items->id] = $items->owner.' - '.$items->last_four;
        }
        return $this->launchView('processPayment', array('paymentProfiles' => $paymentProfiles));
    }

    public function paymentProcessPost(Request $request) {
        $paymentProfile = $this->module['authorizeprofiles']->where('id', $request->input('paymentProfile'))->first();

        if (!defined('AUTHORIZENET_API_LOGIN_ID')) {
            $authorize = $this->module['authorizekeys']->where('id', $paymentProfile->cid)->first();
            define("AUTHORIZENET_API_LOGIN_ID", $authorize->api_login_id);
            define("AUTHORIZENET_TRANSACTION_KEY", $authorize->transaction_key);
            if ($authorize->sandbox == 1) {
                define("AUTHORIZENET_SANDBOX", true);
            } else {
                define("AUTHORIZENET_SANDBOX", false);
            }
        }

        $authorize_cim                         = new \AuthorizeNetCIM;
        $transaction                           = new \AuthorizeNetTransaction;
        $transaction->amount                   = $request->input('amount');
        $transaction->customerProfileId        = $paymentProfile->authorize_id_customer;
        $transaction->customerPaymentProfileId = $paymentProfile->authorize_id_cc;
        if ($request->input('name') != '') {
            $lineItem                              = new \AuthorizeNetLineItem;
            $lineItem->itemId                      = $request->input('itemId');
            $lineItem->name                        = $request->input('name');
            $lineItem->description                 = $request->input('description');
            $lineItem->quantity                    = $request->input('quantity');
            $lineItem->unitPrice                   = $request->input('unitPrice');
            $lineItem->taxable                     = $request->input('taxable');
            $transaction->lineItems[]              = $lineItem;
        }

        $response = $authorize_cim->createCustomerProfileTransaction("AuthCapture", $transaction);
        echo '<pre>';
        print_r($response);
        echo '</pre>';
        exit;
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
