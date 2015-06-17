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


// Super Admin
Route::group(['prefix' => '/admin/super/'], function() {
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

	$superAdminList = array(
		array('get'  , ''                                    , 'index')                  ,
		array('get'  , 'createObject'                        , 'createObject')           ,
		array('get'  , 'viewObject/{objectName}'             , 'viewRecords')            ,
		array('get'  , 'viewObjects'                         , 'viewObjects')            ,
		array('get'  , 'viewObject/{objectName}/{id}'        , 'viewObjectItem')         ,
		array('get'  , 'viewObject/{objectName}/{id}/edit'   , 'editObjectItem')         ,
		array('get'  , 'viewWorkflow/{workflowItem}'         , 'viewWorkflow')           ,
		array('get'  , 'viewWorkflows'                       , 'viewWorkflows')          ,
		array('get'  , 'createWorkflow'                      , 'createWorkflow')         ,
		array('get'  , 'viewForm/{id}'                       , 'viewForm')               ,
		array('get'  , 'viewForms'                           , 'viewForms')              ,
		array('get'  , 'createForms'                         , 'createForms')            ,
		array('post' , 'createObject'                        , 'createObjectPost')       ,
		array('post' , 'createWorkflow'                      , 'createWorkflowPost')     ,
		array('post' , 'createRelationship'                  , 'createRelationshipPost') ,
		array('post' , 'viewObject/{objectFieldsNeeded}'     , 'viewObjectAddRecord')    ,
		array('post' , 'viewObject/{objectName}/{id}/edit'   , 'editObjectItemPost')     ,
		array('post' , 'createForms'                         , 'createFormsPost')        ,
		array('post' , 'getFields/{objectFieldsNeeded}'      , 'getObjectsFields')       ,
		);

	foreach ($superAdminList as $item) {
		$item[0]($item[1], 'superAdminController@'.$item[2]);
	}
	get('template/format/{id}' , 'superAdminTemplatesController@templateFormat');
	post('template/format/{id}' , 'superAdminTemplatesController@templateFormat');
	get('forms/format/{id}' , 'superAdminFormsController@formFormat');
	post('forms/format/{id}' , 'superAdminFormsController@formFormat');


	// Super Admin Controller

	$superAdminControllers = array(
		'api'            => 'Api',
		'pdf'            => 'Pdf',
		'formprocessing' => 'FormProcessing',
		'template'       => 'Templates',
		'pages'          => 'Pages',
		'relationships'  => 'Relationships',
		'forms'			 => 'Forms',
		'workflows'		 => 'Workflows',
		'objects'		 => 'Objects'
		);

	foreach ($superAdminControllers as $key => $item) {
		resource($key , 'superAdmin'.$item.'Controller');
	}
});


// Admin Controller
Route::get('/admin/', 'adminController@index');
// Front Controller
Route::get('/{custom_url}', 'pagesController@index');