<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

#guest route
Route::middleware(['guest'])->group(function(){
	Route::view('/','index');
});

Route::get('/home','HomeController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout')->name('logout');

#setting
Route::prefix('setting')->group(function(){
	Route::post('/createNewProject','SettingController@createNewProject');
	Route::post('/switchProject','SettingController@switchProject');
	Route::post('/invitation','SettingController@updateInvitation');
	Route::post('/user','SettingController@editUserInfo');
	Route::get('','SettingController@index');
	
});
Route::get('/timeline','TimelineController@index');
#task
Route::prefix('task')->group(function(){
	Route::get('/autoComplete','TaskController@autoComplete');
	Route::post('/{id}/change-status','TaskController@changeStatus');
});
Route::prefix('admin')->group(function(){
	Route::get('/project-message','ProjectMessageController@index');
	Route::post('/project-message','ProjectMessageController@store');
	Route::post('/project-setting/invite-user','ProjectController@inviteUser');
	Route::post('/project-setting/name/{id}','ProjectController@changeProjectName');
	Route::get('/project-setting','ProjectController@index');
});
Route::get('/task/admin','TaskController@admin');
Route::resource('/task','TaskController')->names(['create' =>'task.create']);

#comment
Route::post('/comment','CommentController@store');

#notification
Route::get('/notifications/markAsSeen','NotificationController@markAsSeen');