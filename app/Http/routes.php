<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::bind('objectName', function($input) {
	return App\mfwobjects::where('name', $input)->first();
});

Route::bind('objectFieldsNeeded', function($input) {
	$object = App\mfwobjects::where('name', $input)->first();
	$fields = App\mfwobjects::where('oid', $object->id)->get();
	return array($object->name,$fields);
});

Route::bind('workflowItem', function($input) {
	return App\mfwworkflows::where('workflowitem', $input)->first();
});



// Super Admin Controller
// Super Admin Get
Route::get('/admin/super/'                            , 'superAdminController@index');
Route::get('/admin/super/viewObject/{objectName}'     , 'superAdminController@viewRecords');
Route::get('/admin/super/viewWorkflow/{workflowItem}' , 'superAdminController@viewWorkflow');
Route::get('/admin/super/createObject'                , 'superAdminController@createObject');
Route::get('/admin/super/createWorkflow'              , 'superAdminController@createWorkflow');
Route::get('/admin/super/viewObjects'                 , 'superAdminController@viewObjects');
Route::get('/admin/super/viewWorkflows'               , 'superAdminController@viewWorkflows');

// Super Admin Post
Route::post('/admin/super/createObject'     , 'superAdminController@createObjectPost');
Route::post('/admin/super/createWorkflow'   , 'superAdminController@createWorkflowPost');
Route::post('/admin/super/viewObject/{objectFieldsNeeded}', 'superAdminController@viewObjectAddRecord');
// Admin Controller
Route::get('/admin/'                        , 'adminController@index');
// Front Controller


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
