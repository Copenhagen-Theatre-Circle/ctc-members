<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;


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
      $people=Person::orderBy('last_name', 'asc')->get();
      return view('members', ['people' => $people]);
  }//
}
