<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('member');
    }

    public function index()
    {
        $user = \Auth::user()->id;
        return view('userinfo', ['user' => User::find($user)]);
    }  //

    public function profile()
    {
        $user = \Auth::user()->id;
        return view('userprofile', ['user' => User::find($user)]);
    }  //
}
