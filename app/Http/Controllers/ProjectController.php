<?php

namespace App\Http\Controllers;

use App\Project;
use App\AuditionFormAnswer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::whereHas('audition_form_answers', function ($query) {
                        $query->where('id', '>', 0);
                    })->get();
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
    public function show(Project $project)
    {
        $project_id = $project->id;

        // $project = Project::with('audition_form_answers')->orderByJoin('audition_form_answers.person.first_name')->where('id',$project_id)->get();
        // $project->sortBy('first_name');
        // return $project;

        $answers = AuditionFormAnswer::with('person')->orderByJoin('person.first_name')->where('project_id',$project_id)->get();
        // $answers_sorted = $answers->sortBy('person_id');
        // $answers_sorted->all();

        // $answers = $answers->sortBy(function($item) {
        //   return $item->person_id;
        // });
        // return $answers;
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
