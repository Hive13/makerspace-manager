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

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'v1'], function () {
        Route::get('perm/{key}/{perm}', 'PermissionController@checkPermission');
        Route::get('trans/{key}/{type}/{amount?}', 'TransactionController@makeTransaction');
    });
});

Route::get('docs/{page}', 'StaticController@getPage');

Route::resource('trans', 'TransactionController');
Route::post('trans/gift','TransactionController@processGift');

Route::post('perm/user', 'PermissionController@grantPermission');
Route::delete('perm/user', 'PermissionController@deletePermission');

Route::post('perm/master', 'PermissionController@grantMaster');

Route::resource('perm', 'PermissionController');

Route::controller('friends','FriendshipController');

Route::controller('admin','AdminController');

Route::resource('transtype','TransactionTypeController');