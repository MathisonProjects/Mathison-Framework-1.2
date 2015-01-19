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

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

// Super Admin Controller
Route::get('/admin/super/'                  , 'superAdminController@index');
Route::get('/admin/super/view/{objectName}' , 'superAdminController@viewRecords');
Route::get('/admin/super/createObject'      , 'superAdminController@createObject');
// Admin Controller
Route::get('/admin/'                        , 'adminController@index');
// Front Controller


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
