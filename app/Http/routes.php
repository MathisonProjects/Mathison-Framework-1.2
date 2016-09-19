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
Route::group(['prefix' => 'admin/super'], function() {
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
	Route::group(['prefix' => 'objects'], function() {
		get('{id}/delete'    					, 'superAdminObjectsController@destroy');
		get('{id}/rename'						, 'superAdminObjectsController@rename');
		get('{id}/editColumns'					, 'superAdminObjectsController@editColumns');
		get('{objectId}/truncate'				, 'superAdminObjectsController@truncateTable');
		get('create'						    , 'superAdminObjectsController@create');
		get('sorting'							, 'superAdminObjectsController@sortDisplay');
		get('{objectName}'						, 'superAdminObjectsController@viewRecords');
		get('{objectName}/{id}'					, 'superAdminObjectsController@viewObjectItem');
		get('{objectName}/{id}/edit'			, 'superAdminObjectsController@editObjectItem');
		post('sorting'							, 'superAdminObjectsController@postSortDisplay');
		post('sorting/test'						, 'superAdminObjectsController@postSortingTest');
		post('{id}/getFieldList'				, 'superAdminObjectsController@getFields');
		post('{id}/delete'   					, 'superAdminObjectsController@destroy');
		post('{id}/rename'						, 'superAdminObjectsController@renamePost');
		post('{id}/editColumns'					, 'superAdminObjectsController@editColumnsPost');
		post('{id}/import'   					, 'superAdminObjectsController@import');
		post('{objectFieldsNeeded}'				, 'superAdminObjectsController@viewObjectAddRecord');
		post('{objectName}/{id}/edit'			, 'superAdminObjectsController@editObjectItemPost');
		post('getFields/{objectFieldsNeeded}'	, 'superAdminObjectsController@getObjectsFields');
		post('{id}/{oid}/getJsonObjectItemData'	, 'superAdminObjectsController@getJsonObjectItemData');

	});
	post('createObject'          					, 'superAdminObjectsController@createObjectPost');

	Route::group(['prefix' => 'authorizenet'], function() {
		get('/credentials/create'      , 'superAdminAuthorizeNetController@apiKeyCreate');
		get('/credentials'             , 'superAdminAuthorizeNetController@apiKeyView');
		get('/credentials/{id}/delete' , 'superAdminAuthorizeNetController@apiKeyDelete');
		get('/profiles/create'         , 'superAdminAuthorizeNetController@paymentProfileCreate');
		get('/profiles'                , 'superAdminAuthorizeNetController@paymentProfileView');
		get('/profiles/{id}/delete'    , 'superAdminAuthorizeNetController@paymentProfileDelete');
		get('/payments/create'         , 'superAdminAuthorizeNetController@paymentProcess');
		get('/payments'                , 'superAdminAuthorizeNetController@paymentsView');
		post('/credentials/create'     , 'superAdminAuthorizeNetController@apiKeyCreatePost');
		post('/profiles/create'        , 'superAdminAuthorizeNetController@paymentProfileCreatePost');
		post('/payments/create'        , 'superAdminAuthorizeNetController@paymentProcessPost');
	});
	Route::group(['prefix' => 'paypal'], function() {
		get('/credentials/create'      , 'superAdminPaypalController@apiKeyCreate');
		get('/credentials'             , 'superAdminPaypalController@apiKeyView');
		get('/credentials/{id}/delete' , 'superAdminPaypalController@apiKeyDelete');
		get('/profiles/create'         , 'superAdminPaypalController@paymentProfileCreate');
		get('/profiles'                , 'superAdminPaypalController@paymentProfileView');
		get('/profiles/{id}/delete'    , 'superAdminPaypalController@paymentProfileDelete');
		get('/payments/create'         , 'superAdminPaypalController@paymentProcess');
		get('/payments'                , 'superAdminPaypalController@paymentsView');
		post('/credentials/create'     , 'superAdminPaypalController@apiKeyCreatePost');
		post('/profiles/create'        , 'superAdminPaypalController@paymentProfileCreatePost');
		post('/payments/create'        , 'superAdminPaypalController@paymentProcessPost');
	});


	// Accounts
	get('logout'      , 'superAdminAccountsController@logout');
	post('createAdmin', 'superAdminAccountsController@createAdmin');
	post('adminLogin' , 'superAdminAccountsController@adminLogin');

	// PDFs
	get('pdfs/{id}/download', 'superAdminPdfsController@download');

	// CRONs
	get('crons/run', 'superAdminCronsController@run');
	post('crons/run', 'superAdminCronsController@run');
	get('craigslistScraper/showList', 'superAdminCraigslistScraperController@showList');
	post('craigslistScraper/addToCache', 'superAdminCraigslistScraperController@addToCache');

	// Super Admin Controller
	$superAdminControllers = array(
		'accounts'		  ,  'apis'           	,
		'constants'		  ,  'formProcessing' 	,
		'forms'			  ,  'middlewares'	  	,
		'objects'		  ,  'pages'          	,
		'pdfs'            ,  'relationships'  	,
		'reports'		  ,  'sessions'		  	,
		'templates'       ,  'workflows'	  	,
		'googleDrives'    ,  'googleCredentials',
		'crons'			  ,  'craigslistScraper',
		'craigslistFilter',  'lPCampaigns'		,
		'landingPages');

	foreach ($superAdminControllers as $item) {
		resource($item , 'superAdmin'.ucfirst($item).'Controller');
		get($item.'/{id}/destroy','superAdmin'.ucfirst($item).'Controller@destroy');
		post($item.'/{id}/destroy','superAdmin'.ucfirst($item).'Controller@destroy');
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
get('api/{city}/{category}', 'superAdminCraigslistScraperController@getSearchResults');