<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Settings;
use App\Crewfunction;
use App\Functiongroup;
use App\User;
use DB;



class MembersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('member');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    // eager load questionnaire_answers

    $people = Person::with('questionnaire_answers');


    // query if name search

    if (!empty(request('name'))) {
      $people->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . request('name') . '%');
    }


    // query if general interest search

    if (!empty(request('g'))) {
      $people->whereHas('questionnaire_answers', function($q){
        $q->where('functiongroup_id',request('g'));
      });
    }

    // query if specific interest search

    if (!empty(request('f'))) {
      $people->whereHas('questionnaire_answers', function($q){
        $q->where(['interest'=>1,'function_id'=>request('f')]);
        if (request('e')==1) {
            $q->where(['has_experience'=>1]);
        } elseif (request('e')==2) {
            $q->where(['has_experience'=>0]);
            $q->where(['wants_to_learn'=>1]);
        }
        elseif (request('e')==3) {
            $q->where(['wants_to_learn'=>1]);
        }
      });
    }

    $season_id = 50;

    // query if CTC Member search

    if (request('c')==1) {
      $people->whereHas('memberships', function($q){
        $q->where('season_id',Settings::find(1)->active_season_id);
      });
    }

    if (request('c')==2) {
      $people->whereDoesntHave('memberships', function($q){
        $q->where('season_id',Settings::find(1)->active_season_id);
      });
    }


    // order by

    $people->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');

    // execute query

    $people = $people->get();

    // TODO: refactor this into query (scope?)
    // filter only members if not special rights, else members and people who answered questionnaire

    $user_id = \Auth::user()->id;
    $user_model = User::find($user_id);

    if ($user_model->canSeeAllPeople() == false)

    {

      $people = $people->filter(function ($item) {
      return $item->ismember();
      })->values();

    } else {

      $people = $people->filter(function ($item) {
      return ($item->answeredQuestionnaire() || $item->ismember());
      })->values();

    }

    // retrieve functiongroups and functions

    $functiongroups = Functiongroup::orderBy('sort_order')->get();
    $functions = Crewfunction::get()->sortBy('sort_order')->sortBy('FunctionGroupSortOrder');

    foreach ($functions as $function) {
      $functionarray[$function->functiongroup][$function->id]=$function->questionnaire_name;
    }

    // count people to pass result

    $peoplecount = $people->count();

    // pass on request params for c and e

    $request['name'] = request('name');
    $request['f'] = request('f');
    $request['g'] = request('g');
    $request['c'] = request('c');
    $request['e'] = request('e');

    // return view with data

    return view('people.index', Compact ('people', 'peoplecount', 'functiongroups', 'functionarray', 'request'));

  }
}
