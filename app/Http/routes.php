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


Route::get('user/{id}', 'UserController@show');

Route::auth();
Route::get('social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
Route::get('social/login/{provider}', 'Auth\AuthController@handleProviderCallback');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('/home/msg_post', 'HomeController@post');

Route::get('/user', 'UserController@show');
Route::post('/user/api_post', 'UserController@post');

Route::get('/lockout', 'LockoutController@show');

Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
