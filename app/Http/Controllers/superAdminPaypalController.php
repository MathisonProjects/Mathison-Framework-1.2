<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminAuthorizeNetController extends Controller
{
    public function apiKeyCreate() {
        
    }

    public function apiKeyCreatePost(Request $request) {

    }

    public function apiKeyView() {

    }

    public function apiKeyDelete($id) {

    }

    public function paymentProfileCreate() {

    }

    public function paymentProfileCreatePost(Request $request) {

    }

    public function paymentProfileDelete($id) {

    }

    public function paymentProfileView() {

    }

    public function paymentProcess() {

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
