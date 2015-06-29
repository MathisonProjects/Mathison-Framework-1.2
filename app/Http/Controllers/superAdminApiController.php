<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mfwobjects;
use App\mfwworkflows;
use App\mfwobjectrelationships;
use App\mfwmanageforms;
use App\mfwapis;
use App\mfwformprocessings;
use App\mfwtemplates;
use DB;

class superAdminApiController extends Controller
{

    public function index() {
        $compact = array('apis' => $this->menu['apis']);
        return $this->launchView('api.views',$compact);
    }

    public function create() {
        $array = array('randString' => md5($this->generateRandomString(20)));
        return $this->launchView('api.create',$array);
    }

    public function store(Request $request) {
        parent::save('apis','create',$request);
    }

    public function show($id) {
        $api = array('api' => mfwapis::where('id', $id)->first());
        return $this->launchView('api.view',$api);
    }

    public function edit($id) {
        return $this->launchView('api.edit',array());
    }

    public function update(request $request, $id) {
        parent::save('pages','update',$request, array('id' => $id));
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
