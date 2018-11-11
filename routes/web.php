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

#project
Route::get('/home/projects','ProjectController@index');
Route::post('/home/projects','ProjectController@store');
Route::post('/home/projects/switch-project','ProjectController@switchProject');
Route::post('/home/projects/invitation','ProjectController@invitation');

#setting
Route::prefix('settings')->group(function(){
	Route::post('/user','SettingController@user');
	Route::get('','SettingController@index');
});

Route::get('/timelines','TimelineController@index');

#task
Route::prefix('tasks')->group(function(){
	Route::get('/autoComplete','TaskController@autoComplete');
	Route::post('/{id}/change-status','TaskController@changeStatus');
});

Route::prefix('admins')->group(function(){
  Route::get('/tasks','AdminController@indexTask');
  Route::get('/tasks/create','AdminController@createTask')->name('admins.tasks.create');
  Route::post('/tasks','AdminController@storeTask');
  Route::get('/tasks/{id}/edit','AdminController@editTask')->name('admins.tasks.edit');;
  Route::put('/tasks/{id}','AdminController@updateTask');
	Route::delete('/tasks/{id}','AdminController@deleteTask');
	Route::post('/project/invite-user','AdminController@inviteUser');
  Route::get('/project','AdminController@editProject');
});

Route::resource('/tasks','TaskController');

#comment
Route::post('/comments','CommentController@store');

#notification
Route::get('/notifications/markAsSeen','NotificationController@markAsSeen');