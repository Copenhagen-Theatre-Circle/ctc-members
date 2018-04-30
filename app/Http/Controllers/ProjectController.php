<?php

namespace App\Http\Controllers;

use App\Project;
use App\AuditionFormAnswer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('member');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('accounting_only',null)->orderBy('id','desc')->get();
        return view ('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Request $request)
    {

        $rights = \App\Right::where('project_id',$project->id)
                  ->where ('person_id',auth_person())
                  ->get();

        // return $rights;

        $project->load(
          'projects_plays.play',
          'projects_plays.actors.character',
          'projects_plays.actors.person',
          'projects_plays.crewmembers.crewtype',
          'projects_plays.crewmembers.person'
          );

        if(count($rights)>0){
          $project->load(
            'audition_form_answers.person');
        }

        return $project;


        $answers = AuditionFormAnswer::with('person');
        $sort = $request->input('sort');
        if ($sort == 'first_name'){
            $answers = $answers->orderByJoin('person.first_name');
        } elseif ($sort == 'last_name') {
            $answers = $answers->orderByJoin('person.last_name');
        } elseif ($sort == 'last_update') {
            $answers = $answers->orderBy('created_at');
        }
        $answers = $answers->where('project_id',$project->id);
        $answers = $answers->get();

        return view ('projects.show', compact('project','answers'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
