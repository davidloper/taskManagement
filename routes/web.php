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

Route::resource('/home', 'HomeController');
Route::get('/logout','Auth\LoginController@logout')->name('logout');

#setting
Route::prefix('setting')->group(function(){
	Route::post('createNewProject','SettingController@createNewProject');
	Route::post('switchProject','SettingController@switchProject');
	Route::post('findProject','SettingController@findProject');
	Route::post('findUser','SettingController@findUser');
	Route::get('','SettingController@index');
	
});
#task
Route::prefix('task')->group(function(){
	Route::get('/autoComplete','TaskController@autoComplete');

});
	Route::resource('/task','TaskController');

#comment
Route::post('/comment','CommentController@store');

#notification
Route::get('/notifications/markAsSeen','NotificationController@markAsSeen');