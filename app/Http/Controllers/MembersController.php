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
      })->get();
    } elseif (!empty(request('f'))) {
      $people = Person::with('questionnaire_answers')->whereHas('questionnaire_answers', function($q){
        $q->where(['interest'=>1,'function_id'=>request('f')]);
      })->get();
    }
    else
    {
      $people=Person::orderBy('first_name', 'asc')->orderBy('last_name', 'asc')->get();
    }

    $functiongroups = Functiongroup::orderBy('sort_order')->get();
    $functions = Crewfunction::orderBy('sort_order')->get();


    return view('membership', ['people' => $people, 'functiongroups' => $functiongroups, 'functions'=> $functions]);

  }
}
