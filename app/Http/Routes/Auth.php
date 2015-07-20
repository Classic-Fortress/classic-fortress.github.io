<?php

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'AuthController@getLogout'
]);
Route::post('register', [
	'as'   => 'register',
	'uses' => 'AuthController@postRegister'
]);
Route::post('login', [
	'as'   => 'login',
	'uses' => 'AuthController@postLogin'
]);
Route::get('facebook', [
	'as'   => 'login.facebook',
	'uses' => 'AuthController@redirectToProvider'
]);
Route::get('facebook/callback', 'AuthController@handleProviderCallback');