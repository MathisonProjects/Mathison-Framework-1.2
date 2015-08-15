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

	get('', 'superAdminController@index');

	// Templates
	get('templates/format/{id}'  , 'superAdminTemplatesController@templateFormat');
	post('templates/format/{id}' , 'superAdminTemplatesController@templateFormat');

	// Forms
	get('forms/format/{id}'      , 'superAdminFormsController@formFormat');
	post('forms/format/{id}'     , 'superAdminFormsController@formFormat');

	// Objects
	get('objects/{id}/delete'    					, 'superAdminObjectsController@destroy');
	get('objects/{id}/rename'						, 'superAdminObjectsController@rename');
	get('objects/{id}/editColumns'					, 'superAdminObjectsController@editColumns');
	get('objects/create'						    , 'superAdminObjectsController@create');
	get('objects/sorting'							, 'superAdminObjectsController@sortDisplay');
	get('objects/{objectName}'						, 'superAdminObjectsController@viewRecords');
	get('objects/{objectName}/{id}'					, 'superAdminObjectsController@viewObjectItem');
	get('objects/{objectName}/{id}/edit'			, 'superAdminObjectsController@editObjectItem');
	post('objects/sorting'							, 'superAdminObjectsController@postSortDisplay');
	post('objects/{id}/getFieldList'				, 'superAdminObjectsController@getFields');
	post('objects/{id}/delete'   					, 'superAdminObjectsController@destroy');
	post('objects/{id}/rename'						, 'superAdminObjectsController@renamePost');
	post('objects/{id}/editColumns'					, 'superAdminObjectsController@editColumnsPost');
	post('objects/{id}/import'   					, 'superAdminObjectsController@import');
	post('createObject'          					, 'superAdminObjectsController@createObjectPost');
	post('objects/{objectFieldsNeeded}'				, 'superAdminObjectsController@viewObjectAddRecord');
	post('objects/{objectName}/{id}/edit'			, 'superAdminObjectsController@editObjectItemPost');
	post('objects/getFields/{objectFieldsNeeded}'	, 'superAdminObjectsController@getObjectsFields');


	// Accounts
	get('logout'      , 'superAdminAccountsController@logout');
	post('createAdmin', 'superAdminAccountsController@createAdmin');
	post('adminLogin' , 'superAdminAccountsController@adminLogin');

	// PDFs
	get('pdfs/{id}/download', 'superAdminPdfsController@download');

	// CRONs
	get('crons/run', 'superAdminCronsController@run');
	post('crons/run', 'superAdminCronsController@run');

	// Super Admin Controller
	$superAdminControllers = array(
		'accounts'		 ,  'apis'            ,
		'constants'		 ,  'formProcessings' ,
		'forms'			 ,  'middlewares'	  ,
		'objects'		 ,  'pages'           ,
		'pdfs'           ,  'relationships'   ,
		'reports'		 ,  'sessions'		  ,
		'templates'      ,  'workflows'		  ,
		'googleDrives'   ,  'googleCredentials',
		'crons');

	foreach ($superAdminControllers as $item) {
		resource($item , 'superAdmin'.ucfirst($item).'Controller');
	}
});

// API Version 1
Route::group(['prefix' => '/api/v1/'], function() {
	post('/', 'superAdminApisController@runProcess');
});

// Admin Panel
Route::group(['prefix' => '/admin'], function() {
	get('', 'adminController@index');
});

// Front Controller
get('/{custom_url}', 'pagesController@index');

post('/upload', 'superAdminController@uploads');