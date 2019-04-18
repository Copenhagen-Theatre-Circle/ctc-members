<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/members', function(){
    return App\Person::all();
});

Route::apiResources([
    'projects' => 'API\ProjectController',
    'people' => 'API\PersonController',
    'characters' => 'API\CharacterController',
    'seasons' => 'API\SeasonController',
    'venues' => 'API\VenueController',
]);

Route::resource('person','PersonController');

Route::resource('questionnaire_answers','QuestionnaireAnswerController');
