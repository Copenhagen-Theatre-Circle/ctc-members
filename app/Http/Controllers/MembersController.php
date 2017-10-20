<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Crewfunction;
use App\Functiongroup;


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

    if (!empty(request('first_name'))){$where['first_name']=request('first_name');}
    if (!empty(request('last_name'))){$where['last_name']=request('last_name');}
    if (!empty(request('g'))){$wherehas['functiongroup_id']=request('g');}
    if (!empty(request('f'))){$wherehas['function_id']=request('f');}

    if (!empty($where)) {
      $people = Person::with('questionnaire_answers')->where($where)->get();
    } elseif (!empty($wherehas)) {
      $people = Person::with('questionnaire_answers')->whereHas('questionnaire_answers', function($q){
        if (!empty(request('g'))){$q->where('functiongroup_id',request('g'));}
        elseif (!empty(request('f'))){$q->where('function_id',request('f'));}
      })->get();
    }
    else
    {
      $people=Person::orderBy('last_name', 'asc')->get();
    }

    $functiongroups = Functiongroup::orderBy('sort_order')->get();
    $functions = Crewfunction::orderBy('sort_order')->get();

    return view('membership', ['people' => $people, 'functiongroups' => $functiongroups, 'functions'=> $functions]);

  }
}
