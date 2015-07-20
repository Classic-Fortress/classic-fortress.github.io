<?php

Route::resource('/', 'ForumController');
Route::resource('forum.topic', 'ForumTopicController');
Route::resource('forum.topic.message', 'ForumMessageController');

Route::get('/', [
	'as'   => 'forum',
	'uses' => 'ForumController@index'
]);

Route::get('{forum}', [
	'as'   => 'forum.category',
	'uses' => 'ForumController@show'
]);

Route::put('{forum}', [
	'as'   => 'forum.update',
	'uses' => 'ForumController@update'
]);

Route::get('{forum}/edit', [
	'as'   => 'forum.edit',
	'uses' => 'ForumController@edit'
]);

Route::get('{forum}/post', [
	'as'   => 'forum.topic.create',
	'uses' => 'ForumTopicController@create'
]);

Route::get('{forum}/{id}-{topic}', [
	'as'   => 'forum.topic',
	'uses' => 'ForumTopicController@show'
]);

Route::post('{forum}/{id}-{topic}', [
	'as'   => 'forum.topic.message.post',
	'uses' => 'ForumMessageController@store'
]);

Route::get('{forum}/{id}-{topic}/{messageId}', [
	'as'   => 'forum.topic.message.edit',
	'uses' => 'ForumMessageController@edit'
]);

Route::put('{forum}/{id}-{topic}/{messageId}', [
	'as'   => 'forum.topic.message.update',
	'uses' => 'ForumMessageController@update'
]);

Route::delete('{forum}/{id}-{topic}/{messageId}', [
	'as'   => 'forum.topic.message.destroy',
	'uses' => 'ForumMessageController@destroy'
]);

Route::post('{forum}/{id}-{topic}/rate', [
	'as'   => 'forum.topic.message.rate',
	'uses' => 'ForumMessageController@rate'
]);

Route::get('{forum}/{id}-{topic}/{message}/answer', [
	'as'   => 'forum.topic.message.answer',
	'uses' => 'ForumMessageController@answer'
]);


Route::post('{forum}/new', [
	'as'   => 'forum.topic.post',
	'uses' => 'ForumTopicController@store'
]);