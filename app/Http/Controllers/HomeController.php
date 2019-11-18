<?php

namespace App\Http\Controllers;

use App\User;
use App\RebateCodeAllocator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $user_id = \Auth::user()->id;
        $user = User::find($user_id);
        $user_is_admin = $user->canSeeAllPeople();

        $person_id = $_GET['person'] ?? $user->person->id;

        //generate rebate codes for selected show:
        $project_id = 155;
        $rebatecodeallocator = new RebateCodeAllocator($project_id, $person_id);
        $import = $rebatecodeallocator->allocateCodes();

        $codes = DB::select(DB::raw("

            SELECT code, rebate, first_name, last_name, r.person_id
            FROM people p
            INNER JOIN rebatecodes r
            ON p.id = r.`person_id`
            WHERE p.id = $person_id
            AND r.project_id = $project_id

            UNION

            SELECT code, rebate, p2.first_name, p2.last_name, r.person_id
            FROM people p
            INNER JOIN memberships m
            ON p.id = m.`person_purchaser_id`
            INNER JOIN people p2
            ON p2.id = m.person_id
            INNER JOIN rebatecodes r
            ON r.`person_id` = m.`person_id`
            WHERE p.id = $person_id
            AND r.project_id = $project_id
            ORDER BY person_id

            "));


        // return $result;


        return view('home', Compact('user', 'user_is_admin', 'codes'));
    }
}
