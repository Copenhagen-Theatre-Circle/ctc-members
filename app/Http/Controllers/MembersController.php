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
        $people = Person::select('first_name', 'last_name', 'mail', 'id', 'is_life_member');

        $people->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');

        // scope: people who answered questionnaire or are members if special rights, else only members
        if (user_is_admin_or_superuser()) {
            $people->answeredQuestionnaireOrIsMember();
        } else {
            $people->isMember();
        }

        // queries here
        // TODO: refactor this into scopes

        // query if name search

        if (!empty(request('name'))) {
            $people->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . request('name') . '%');
        }


        // query if general interest search

        if (!empty(request('g'))) {
            $people->whereHas('questionnaire_answers', function ($q) {
                $q->where('functiongroup_id', request('g'));
            });
        }

        // query if specific interest search

        if (!empty(request('f'))) {
            $people->whereHas('questionnaire_answers', function ($q) {
                $q->where(['interest'=>1,'function_id'=>request('f')]);
                if (request('e')==1) {
                    $q->where(['has_experience'=>1]);
                } elseif (request('e')==2) {
                    $q->where(['has_experience'=>0]);
                    $q->where(['wants_to_learn'=>1]);
                } elseif (request('e')==3) {
                    $q->where(['wants_to_learn'=>1]);
                }
            });
        }

        // query if CTC Member search

        if (request('c')==1) {
            $people->whereHas('memberships', function ($q) {
                $q->where('season_id', Settings::find(1)->active_season_id);
            })
            ->orWhere('is_life_member', 1);
        }

        if (request('c')==2) {
            $people->whereDoesntHave('memberships', function ($q) {
                $q->where('season_id', Settings::find(1)->active_season_id);
            })->whereNull('is_life_member');
        }

        // execute query

        $people = $people->get();

        // eager load required related data

        $people->load(
            'portraits',
            'membership_this_season',
            'questionnaire_answers'
        );

        // retrieve functiongroups and functions

        $functiongroups = Functiongroup::orderBy('sort_order')->get();
        $functiongroups->load('crewfunctions');

        // return view with data

        return view('people.index', Compact('people', 'functiongroups'));
    }
}
