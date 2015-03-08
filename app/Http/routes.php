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
$superAdminList = array(
	array('GET'  , ''                                    , 'index')                  ,
	array('GET'  , 'createObject'                        , 'createObject')           ,
	array('GET'  , 'viewObject/{objectName}'             , 'viewRecords')            ,
	array('GET'  , 'viewObjects'                         , 'viewObjects')            ,
	array('GET'  , 'viewObject/{objectName}/{id}'        , 'viewObjectItem')         ,
	array('GET'  , 'viewObject/{objectName}/{id}/edit'   , 'editObjectItem')         ,
	array('GET'  , 'viewRelationship/{relationshipName}' , 'viewRelationship')       ,
	array('GET'  , 'viewRelationships'                   , 'viewRelationships')      ,
	array('GET'  , 'viewWorkflow/{workflowItem}'         , 'viewWorkflow')           ,
	array('GET'  , 'viewWorkflows'                       , 'viewWorkflows')          ,
	array('GET'  , 'createWorkflow'                      , 'createWorkflow')         ,
	array('GET'  , 'viewForm/{id}'                       , 'viewForm')               ,
	array('GET'  , 'viewForms'                           , 'viewForms')              ,
	array('GET'  , 'createForms'                         , 'createForms')            ,
	array('GET'  , 'createFormProcess'                   , 'createFormProcesses')    ,
	array('GET'  , 'viewFormProcesses'                   , 'viewFormProcesses')      ,
	array('GET'  , 'viewFormProcess/{id}'                , 'viewFormProcess')        ,
	array('GET'  , 'createApi'                           , 'createApi')              ,
	array('GET'  , 'viewApis'                            , 'viewApis')               ,
	array('GET'  , 'viewApi/{id}'                        , 'viewApi')                ,
	array('POST' , 'createObject'                        , 'createObjectPost')       ,
	array('POST' , 'createWorkflow'                      , 'createWorkflowPost')     ,
	array('POST' , 'createRelationship'                  , 'createRelationshipPost') ,
	array('POST' , 'viewObject/{objectFieldsNeeded}'     , 'viewObjectAddRecord')    ,
	array('POST' , 'viewObject/{objectName}/{id}/edit'   , 'editObjectItemPost')     ,
	array('POST' , 'createForms'                         , 'createFormsPost')        ,
	array('POST' , 'createApi'                           , 'createApiPost')              ,
	array('POST' , 'getFields/{objectFieldsNeeded}'      , 'getObjectsFields')       ,
	);

foreach ($superAdminList as $item) {
	if ($item[0] == 'GET') {
		get( '/admin/super/'.$item[1], 'superAdminController@'.$item[2]);
	} else if ($item[0] == 'POST') {
		post('/admin/super/'.$item[1], 'superAdminController@'.$item[2]);
	}
}

// Admin Controller
Route::get('/admin/', 'adminController@index');
// Front Controller