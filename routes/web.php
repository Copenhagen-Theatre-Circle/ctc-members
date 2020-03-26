<?php

use App\MembershipImporter;
use App\RebateCodeAllocator;
use Illuminate\Http\Request;

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

Route::get('/nomember', function () {
  return redirect('home');
});

Route::get('/membership', 'MembersController@index')->name('membership');

Route::get('/export/auditions/{project}', 'ExportController@auditions');

Route::get('/ticketsales/import/{project}', 'TicketsalesController@import');

Route::get('/profile','UserController@profile');

Route::get('/handbooks','UserController@handbooks');

Route::get('/prototype','PrototypeController@index');
Route::get('/signup', function () {
    return view('signup');
});

// Route::get('/export', 'ExportController@auditions');

// Route::get('/projects/{id}', 'ProjectController@show');

Route::get('people/map', 'PersonController@map');

Route::resources([
    'audition_form_answers' => 'AuditionFormAnswersController',
    'auditions'=>'AuditionController',
    'actors'=>'ActorController',
    'directors'=>'DirectorController',
    'help'=>'HelpController',
    'crewmembers'=>'CrewmemberController',
    'comments'=>'CommentsController',
    'essays'=>'EssaysController',
    'events'=>'EventController',
    'groupmessage'=>'GroupMessageController',
    'mappings'=>'MappingController',
    'memberbenefits'=>'MemberbenefitController',
    'message'=>'MessageController',
    'person'=>'PersonController',
    'people'=>'PersonController',
    'photographs'=>'PhotographController',
    'phototags'=>'PhototagController',
    'preferences'=>'UserpreferenceController',
    'posts'=>'PostController',
    'projects'=>'ProjectController',
    'suggestions'=>'SuggestionController',
    'test'=>'TestController',
    'ticketsales' => 'TicketsalesController'
]);

Route::get('/jubilee-book/','JubileeBookController@redirect_to_user');
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

Route::post('/upload-photo','PhotoUploadController@store');
Route::post('/upload-document','DocumentUploadController@store');

Route::get('/tributes/{slug}', 'TributeController@show');


Route::get('message/confirmation',function () {
  return view('contactconfirmation');
});

// Route::get('/storage', function (){
//     return 'hello world';
// });

// Route::get('/files/thumb/{filename}', 'ImageController@showThumb')->name('thumbnail');
// Route::get('/files/{filename}', 'ImageController@show')->name('file');

Route::get('/upload-file','FilesController@create');
Route::post('/process', function (Request $request) {
    $path = $request->file('file')->store('public');
    dd($path);
});

Route::get('membershipimporter/{season}', function ($season) {
    $importer = new MembershipImporter($season);
    $import = $importer->importData();
    return $import;
});

Route::get('rebatecodeallocator/{project}/{person}', function ($project, $person) {
    $importer = new RebateCodeAllocator($project, $person);
    $import = $importer->allocateCodes();
    return $import;
});

Route::get('want-to-direct', function(){
    return view('various.want_to_direct');
});

Route::get('phils-film-quiz', function(){
    return view('various.phils_quiz');
});
