<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
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

    // query people with questionnaire_answers

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
      });
    }


    // order by

    $people->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');

    // execute query

    $people = $people->get();

    // filter only members if not special rights

    $user_id = \Auth::user()->id;
    $user_model = User::find($user_id);

    if ($user_model->canSeeAllPeople() == false){

      $people = $people->filter(function ($item) {
      return $item->ismember();
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

    // return view with data

    return view('membership', ['people' => $people, 'peoplecount' => $peoplecount, 'functiongroups' => $functiongroups, 'functionarray'=> $functionarray]);

  }
}
