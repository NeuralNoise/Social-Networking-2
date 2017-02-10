<?php


Route::get('/',[
'uses' => '\Diskourse\Http\Controllers\HomeController@index',
'as' =>'home',
	]);

Route::get('/alert', function()
{
	return redirect()->route('home')->with('info','you have signed up!!');
});

Route::get('/signup',[
'uses' => '\Diskourse\Http\Controllers\AuthController@getSignup',
'as' => 'auth.signup',
'middleware' =>['guest'],	
]);

Route::post('/signup',[
'uses' => '\Diskourse\Http\Controllers\AuthController@postSignup',
'middleware' =>['guest'],	
]);

Route::get('/signin',[
'uses' => '\Diskourse\Http\Controllers\AuthController@getSignin',
'as' => 'auth.signin',	
'middleware' =>['guest'],	
]);

Route::post('/signin',[
'uses' => '\Diskourse\Http\Controllers\AuthController@postSignin',
'middleware' =>['guest'],	
]);

Route::get('/signout',[
'uses' => '\Diskourse\Http\Controllers\AuthController@getSignout',
'as' => 'auth.signout',
]);

Route::get('/search',[
  'uses' => '\Diskourse\Http\Controllers\SearchController@getResults',
  'as' => 'search.results',
	]);

Route::get('/user/{username}',[
  'uses' => '\Diskourse\Http\Controllers\ProfileController@getProfile',
  'as' => 'profile.index',
	]);

Route::get('/profile/edit',[
 'uses' => '\Diskourse\Http\Controllers\ProfileController@getEdit',
 'as' => 'profile.edit',
 'middleware' => ['auth'],
	]);

Route::post('/profile/edit',[
 'uses' => '\Diskourse\Http\Controllers\ProfileController@postEdit',
 'middleware' => ['auth'],
 	]);

Route::get('/friends',[
 'uses' => '\Diskourse\Http\Controllers\FriendController@getIndex',
 'as' => 'friends.index',
 'middleware' => ['auth'],
	]);


Route::get('/friends/add/{username}',[
 'uses' => '\Diskourse\Http\Controllers\FriendController@getAdd',
 'as' => 'friends.add',
 'middleware' => ['auth'],
	]);


Route::get('/friends/accept/{username}',[
 'uses' => '\Diskourse\Http\Controllers\FriendController@getAccept',
 'as' => 'friends.accept',
 'middleware' => ['auth'],
	]);

Route::post('/status',[
 'uses' => '\Diskourse\Http\Controllers\StatusController@postStatus',
 'as' => 'status.post',
 'middleware' => ['auth'],
	]);


Route::post('/status/{statusId}/reply',[
 'uses' => '\Diskourse\Http\Controllers\StatusController@postReply',
 'as' => 'status.reply',
 'middleware' => ['auth'],
	]);


Route::get('/status/{statusId}/like',[
 'uses' => '\Diskourse\Http\Controllers\StatusController@getLike',
 'as' => 'status.like',
 'middleware' => ['auth'],
	]);

Route::post('/friends/delete/{username}',[
 'uses' => '\Diskourse\Http\Controllers\FriendController@postDelete',
 'as' => 'friends.delete',
 'middleware' => ['auth'],
	]);

Route::get('/studymaterials',[
	'uses'=> '\Diskourse\Http\Controllers\ResourceController@index',
	'as'=> 'templates.studymaterials.index',
	'middleware' => ['guest'],
	]);
	
Route::get('/studymaterials/upload',[
	'uses'=> '\Diskourse\Http\Controllers\ResourceController@getUpload',
	'as'=> 'templates.studymaterials.upload',
	'middleware' => ['guest'],
	]);
Route::post('/studymaterials/upload',[
	'uses'=> '\Diskourse\Http\Controllers\ResourceController@postUpload',
	'middleware' => ['guest'],
	]);
Route::get('/studymaterials/inventory',[
	'uses' => '\Diskourse\Http\Controllers\ResourceController@getInventory',
	'as' => 'templates.studymaterials.inventory',
	'middleware' => ['guest'],
	]);
Route::get('/studymaterials/search',[
	'uses' => '\Diskourse\Http\Controllers\ResourceController@getSearchResults',
	'as' => 'templates.studymaterials.results',
	]);

Route::get('/profile/video', [
	'uses' => '\Diskourse\Http\Controllers\ProfileController@getVideos',
	'as'   => 'profile.video',
]);