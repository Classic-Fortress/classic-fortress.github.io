<?php

/* Auth routes */
Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function() {
	require('Routes/Auth.php');
});

/* Forum routes */
Route::group(['namespace' => 'Forum', 'prefix' => 'forum'], function() {
	require('Routes/Forum.php');
});

Route::resource('user', 'UserController');
Route::delete('user/{user}/role', 'RoleController@destroy');
Route::resource('user.role', 'RoleController');

Route::get('users', [
	'as'   => 'users',
	'uses' =>'UserController@index'
]);

Route::get('user/{user}', [
	'as'   => 'user',
	'uses' =>'UserController@show'
]);


Route::get('wiki', [
	'as'   => 'wiki',
	'uses' =>'HomeController@getWiki'
]);

Route::put('profile/settings', [
	'as' => 'profile.settings.update',
	'uses' => 'ProfileSettingsController@update'
]);

Route::controller('profile', 'ProfileController');
Route::controller('/', 'HomeController');
Route::controller('auth', 'Auth\AuthController');