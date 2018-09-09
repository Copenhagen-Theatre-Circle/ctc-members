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

Route::get('/ticketsales/import/{project}', 'TicketsalesController@import');

Route::get('/profile','UserController@profile');

Route::get('/handbooks','UserController@handbooks');

// Route::get('/export', 'ExportController@auditions');

Route::resources([
    'audition_form_answers' => 'AuditionFormAnswersController',
    'auditions'=>'AuditionController',
    'comments'=>'CommentsController',
    'events'=>'EventController',
    'groupmessage'=>'GroupMessageController',
    'mappings'=>'MappingController',
    'memberbenefits'=>'MemberbenefitController',
    'message'=>'MessageController',
    'person'=>'PersonController',
    'people'=>'PersonController',
    'preferences'=>'UserpreferenceController',
    'posts'=>'PostController',
    'projects'=>'ProjectController',
    'suggestions'=>'SuggestionController',
    'test'=>'TestController',
    'ticketsales' => 'TicketsalesController'
]);

Route::get('/jubilee-book/{person_id}','JubileeBookController@step_1');
Route::get('/jubilee-book/{person_id}/step-1','JubileeBookController@step_1');
Route::post('/jubilee-book/{person_id}/step-1','JubileeBookController@step_1_store')->name('jubilee.step1.store');
Route::get('/jubilee-book/{person_id}/step-2','JubileeBookController@step_2');
Route::post('/jubilee-book/{person_id}/step-2','JubileeBookController@step_2_store')->name('jubilee.step2.store');
Route::get('/jubilee-book/{person_id}/step-3/','JubileeBookController@step_3_index');
Route::get('/jubilee-book/{person_id}/step-3/{show_id}','JubileeBookController@step_3_show');
Route::get('/jubilee-book/{person_id}/step-3/{show_id}/edit','JubileeBookController@step_3_edit');
Route::post('/jubilee-book/{person_id}/step-3/{show_id}/store','JubileeBookController@step_3_store')->name('jubilee.step3.store');
Route::get('/jubilee-book/{person_id}/step-3/essays/{essay_id}/edit','JubileeBookController@step_3_essay_edit');
Route::post('/jubilee-book/{person_id}/step-3/essays/{essay_id}/store','JubileeBookController@step_3_essay_store')->name('jubilee.step3_essay.store');

// Route::resource('audition_form_answers', 'AuditionFormAnswersController');

// Route::resource('comments','CommentsController');

// Route::resource('events','EventController');

// Route::resource('groupmessage','GroupMessageController');

// Route::resource('message','MessageController');

// Route::resource('person','PersonController');

// Route::resource('posts','PostController');

// Route::resource('auditions','AuditionController');

// Route::resource('projects','ProjectController');

// Route::resource('preferences','UserpreferenceController');

// Route::resource('memberbenefits','MemberbenefitController');

// Route::resource('suggestions','SuggestionController');

// Route::resource('ticketsales','TicketsalesController');

// Route::resource('test', 'TestController');

Route::get('message/confirmation',function(){
  return view('contactconfirmation');
});
