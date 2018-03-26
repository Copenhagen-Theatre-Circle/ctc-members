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

Route::get('/membership', 'MembersController@index')->name('membership');

Route::get('/export/auditions/{project}', 'ExportController@auditions');

// Route::get('/export', 'ExportController@auditions');

Route::resource('person','PersonController');

Route::resource('projects','ProjectController');

Route::resource('comments','CommentsController');

Route::resource('preferences','UserpreferenceController');

Route::resource('memberbenefits','MemberbenefitController');

Route::resource('posts','PostController');

Route::resource('audition_form_answers', 'AuditionFormAnswersController');

Route::resource('test', 'TestController');

Route::get('message/confirmation',function(){
  return view('contactconfirmation');
});

Route::resource('message','MessageController');

Route::resource('groupmessage','GroupMessageController');

Route::get('/profile','UserController@profile');
