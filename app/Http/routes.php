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

Route::bind('relationshipName', function($input) {
	return App\mfwobjectrelationships::where('name', $input)->first();
});

// Super Admin Controller
// Super Admin Get
Route::get('/admin/super/'                                    , 'superAdminController@index');
Route::get('/admin/super/createObject'                        , 'superAdminController@createObject');
Route::get('/admin/super/viewObject/{objectName}'             , 'superAdminController@viewRecords');
Route::get('/admin/super/viewObjects'                         , 'superAdminController@viewObjects');
Route::get('/admin/super/viewObject/{objectName}/{id}'        , 'superAdminController@viewObjectItem');
Route::get('/admin/super/viewObject/{objectName}/{id}/edit'   , 'superAdminController@editObjectItem');
Route::get('/admin/super/viewRelationship/{relationshipName}' , 'superAdminController@viewRelationship');
Route::get('/admin/super/viewRelationships'                   , 'superAdminController@viewRelationships');
Route::get('/admin/super/viewWorkflow/{workflowItem}'         , 'superAdminController@viewWorkflow');
Route::get('/admin/super/viewWorkflows'                       , 'superAdminController@viewWorkflows');
Route::get('/admin/super/createWorkflow'                      , 'superAdminController@createWorkflow');
Route::get('/admin/super/viewForm'                            , 'superAdminController@viewForm');
Route::get('/admin/super/viewForms'                           , 'superAdminController@viewForms');
Route::get('/admin/super/createForms'                         , 'superAdminController@createForms');


// Super Admin Post
Route::post('/admin/super/createObject'                       , 'superAdminController@createObjectPost');
Route::post('/admin/super/createWorkflow'                     , 'superAdminController@createWorkflowPost');
Route::post('/admin/super/viewObject/{objectFieldsNeeded}'    , 'superAdminController@viewObjectAddRecord');
Route::post('/admin/super/createRelationship'                 , 'superAdminController@createRelationshipPost');
Route::post('/admin/super/viewObject/{objectName}/{id}/edit'  , 'superAdminController@editObjectItemPost');
// Super Admin Ajax Post
Route::post('/admin/super/getFields/{objectFieldsNeeded}'     , 'superAdminController@getObjectFields');
// Admin Controller
Route::get('/admin/'                                          , 'adminController@index');
// Front Controller


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
