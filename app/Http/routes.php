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
		array('get'  , 'viewObject/{objectName}'             , 'viewRecords')            ,
		array('get'  , 'viewObject/{objectName}/{id}'        , 'viewObjectItem')         ,
		array('get'  , 'viewObject/{objectName}/{id}/edit'   , 'editObjectItem')         ,
		array('get'  , 'logout'								 , 'logout')				 ,
		array('post' , 'createObject'                        , 'createObjectPost')       ,
		array('post' , 'viewObject/{objectFieldsNeeded}'     , 'viewObjectAddRecord')    ,
		array('post' , 'viewObject/{objectName}/{id}/edit'   , 'editObjectItemPost')     ,
		array('post' , 'getFields/{objectFieldsNeeded}'      , 'getObjectsFields')       ,
		array('post' , 'createAdmin'    					 , 'createAdmin')		     ,
		array('post' , 'adminLogin'      					 , 'adminLogin')       		 ,
		);

	foreach ($superAdminList as $item) {
		$item[0]($item[1], 'superAdminController@'.$item[2]);
	}
	get('templates/format/{id}' , 'superAdminTemplatesController@templateFormat');
	post('templates/format/{id}' , 'superAdminTemplatesController@templateFormat');
	get('forms/format/{id}' , 'superAdminFormsController@formFormat');
	post('forms/format/{id}' , 'superAdminFormsController@formFormat');
	get('objects/{id}/delete', 'superAdminObjectsController@destroy');
	post('objects/{id}/delete', 'superAdminObjectsController@destroy');
	post('objects/{id}/import', 'superAdminObjectsController@import');


	// Super Admin Controller
	$superAdminControllers = array(
		'apis'           ,
		'pdfs'           ,
		'formprocessing' ,
		'templates'      ,
		'pages'          ,
		'relationships'  ,
		'forms'			 ,
		'workflows'		 ,
		'objects'		 ,
		'reports'		 ,
		'accounts'		 ,
		'constants'		 ,
		'sessions'		 ,
		'middlewares');

	foreach ($superAdminControllers as $item) {
		resource($item , 'superAdmin'.ucfirst($item).'Controller');
	}
});

Route::group(['prefix' => '/api/v1/'], function() {
	post('/', 'superAdminApisController@runProcess');
});

// Admin Controller
get('/admin/', 'adminController@index');
// Front Controller
get('/{custom_url}', 'pagesController@index');

post('/upload', 'superAdminController@uploads');