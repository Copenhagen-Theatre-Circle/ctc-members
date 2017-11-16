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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index');

Route::get('/nomember', function(){
  return view('nomember');
});

Route::get('/membership', 'MembersController@index');

Route::resource('person','PersonController');

Route::get('message/confirmation',function(){
  return view('contactconfirmation');
});

Route::resource('message','MessageController');

Route::get('/profile','UserController@profile');
