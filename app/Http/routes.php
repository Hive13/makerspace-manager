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

	Route::get('/', 'HomeController@getIndex');

	Route::controller('auth', 'Auth\AuthController');

	Route::resource('user', 'UserController');
	Route::post('user/change_password', 'UserController@changePassword');

	Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {

		Route::group(['prefix' => 'v1', 'namespace' => 'v1'], function () {

			Route::get('ping', function () {

				return "pong";
			});
			Route::get('perm/{key}/{perm_name}', 'PermissionController@checkPermission');
			Route::get('trans/{key}/{type}/{amount?}', 'TransactionController@makeTransaction');
			Route::get('var/get/{var_name}/{key?}','VariableController@get');
			Route::get('var/set/{var_name}/{var_value}/{key?}','VariableController@set');
			Route::get('var/add/{var_name}/{var_value}/{key?}','VariableController@add');
		});
		Route::get('/{var1?}/{var2?}/{var3?}/{var4?}/{var5?}', function () {

			return "false";
		});
	});

	Route::get('docs/{page}', 'StaticController@getPage');

	Route::resource('trans', 'TransactionController');
	Route::post('trans/gift', 'TransactionController@processGift');

	Route::post('perm/user', 'PermissionController@grantPermission');
	Route::delete('perm/user', 'PermissionController@deletePermission');

	Route::post('perm/master', 'PermissionController@grantMaster');

	Route::resource('perm', 'PermissionController');

	Route::controller('friends', 'FriendshipController');

	Route::controller('admin', 'AdminController');

	Route::resource('transtype', 'TransactionTypeController');

	Route::resource('var','VariableController');