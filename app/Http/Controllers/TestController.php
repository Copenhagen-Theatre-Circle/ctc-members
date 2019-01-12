<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ClientErrorResponseException;
use GuzzleHttp\Client;
use App\Event;
use App\Project;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (user_can_see_all_people()){
        $array['can_see_all_people'] = "true";
      } else {
        $array['can_see_all_people'] = "false";
      }
      if (user_is_admin()){
        $array['user_is_admin'] = "true";
      } else {
        $array['user_is_admin'] = "false";
      }
      if (user_is_superuser()){
        $array['user_is_superuser'] = "true";
      } else {
        $array['user_is_superuser'] = "false";
      }
      if (user_is_admin_or_superuser()){
        $array['user_is_admin_or_superuser'] = "true";
      } else {
        $array['user_is_admin_or_superuser'] = "false";
      }
      // $user_can_see_all_people = user_can_see_all_people();
      return $array;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
         $project->load(
            'projects_plays.play.author_play.author',
            'projects_plays.actors.character',
            'projects_plays.actors.person',
            'projects_plays.crewmembers.crewtype',
            'projects_plays.crewmembers.person'
        );
        foreach ($project->projects_plays as $projects_play) {
            foreach ($projects_play->actors as $actor){
                $actors[$actor->id]['person_id']=$actor->person_id;
                $actors[$actor->id]['character_id']=$actor->character_id;
                $actors[$actor->id]['character']=$actor->character->name;
                $actors[$actor->id]['name']=$actor->person->full_name;
            }
        }
        // return $actors;
        // return $project;
        return view ('test.show', Compact('actors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
