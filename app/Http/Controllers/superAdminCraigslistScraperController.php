<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminCraigslistScraperController extends Controller {
    const SOCKET_TIMEOUT = 10;
    const USER_AGENT = "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 GTB5 (.NET CLR 3.5.30729)";

    public function index() {
        
    }

    public function create() {
        
    }

    public function store(Request $request) {
        
    }

    public function show($id) {
        
    }

    public function edit($id) {
        
    }

    public function update(Request $request, $id) {
        
    }

    public function destroy($id) {
        
    }

    
    public function getSearchResults($city, $category) {
        $craigslist = new \Divinityfound\CraigslistApi\Reader;

        echo '<pre>';
        print_r($craigslist->getSearchResults($city,$category));
        echo '</pre>';
        exit;
    }

}