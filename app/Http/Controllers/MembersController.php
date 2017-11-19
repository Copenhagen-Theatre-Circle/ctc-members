<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Crewfunction;
use App\Functiongroup;
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

    if (!empty(request('name'))) {
      $people = Person::with('questionnaire_answers')->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . request('name') . '%')->get();
    } elseif (!empty(request('g'))) {
      $people = Person::with('questionnaire_answers')->whereHas('questionnaire_answers', function($q){
        $q->where('functiongroup_id',request('g'));
      })->orderBy('first_name', 'asc')->orderBy('last_name', 'asc')->get();
    } elseif (!empty(request('f'))) {
      $people = Person::with('questionnaire_answers')->whereHas('questionnaire_answers', function($q){
        $q->where(['interest'=>1,'function_id'=>request('f')]);
      })->orderBy('first_name', 'asc')->orderBy('last_name', 'asc')->get();
    }
    else
    {
      $people=Person::orderBy('first_name', 'asc')->orderBy('last_name', 'asc')->get();
    }

    $people = $people->filter(function ($person) {
    return $person->ismember();
    });

    $functiongroups = Functiongroup::orderBy('sort_order')->get();
    $functions = Crewfunction::get()->sortBy('sort_order')->sortBy('FunctionGroupSortOrder');

    foreach ($functions as $function) {
      $functionarray[$function->functiongroup][$function->id]=$function->questionnaire_name;
    }

    $peoplecount = $people->count();


    return view('membership', ['people' => $people, 'peoplecount' => $peoplecount, 'functiongroups' => $functiongroups, 'functionarray'=> $functionarray]);

  }
}
