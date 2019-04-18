<?php

namespace App\Http\Controllers\API;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'api hello';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $project->load(
            'projects_plays.play.author_play.author',
            'projects_plays.characters',
            'projects_plays.actors.character',
            'projects_plays.actors.person.portraits',
            'projects_plays.crewmembers.crewtype',
            'projects_plays.crewmembers.person.portraits',
            'phototags.photograph.phototype',
            'showpics',
            'videos.hyperlinktype',
            'projectmemories',
            'directors.person'
        );
        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->fill($request->only(
            'season_id',
            'venue_id',
            'date_start',
            'date_end',
            'name',
            'number_of_performances',
            'synopsis',
            'publish_online',
            'publish_members',
            'publish_book',
            'crew_is_complete',
            'cast_is_complete'
            )
        )->save();
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
