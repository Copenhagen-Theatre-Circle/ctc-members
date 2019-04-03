<?php

namespace App\Http\Controllers;

use App\Play;
use App\Event;
use App\Person;
use App\Project;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ClientErrorResponseException;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (user_can_see_all_people()) {
        $array['can_see_all_people'] = "true";
      } else {
        $array['can_see_all_people'] = "false";
      }
      if (user_is_admin()) {
        $array['user_is_admin'] = "true";
      } else {
        $array['user_is_admin'] = "false";
      }
      if (user_is_superuser()) {
        $array['user_is_superuser'] = "true";
      } else {
        $array['user_is_superuser'] = "false";
      }
      if (user_is_admin_or_superuser()) {
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
        $project = Project::select('id','name','season_id')->find($id);
            $project->load(
                'projects_plays.play.author_play.author',
                'projects_plays.actors.character',
                'projects_plays.actors.person',
                'projects_plays.crewmembers.crewtype',
                'projects_plays.crewmembers.person',
                'crewmembers.crewtype',
                'crewmembers.person',
            );

        // return $project;
        $plays = Play::all('id','title');
        $people = Person::select('id','first_name','last_name')->orderBy('last_name')->get();
        // return $people;
        // return $plays;
        return view('test.show', Compact('project','plays','people'));

        foreach ($project->projects_plays as $projects_play) {
            foreach ($projects_play->actors as $actor) {
                $subarray['id']=$actor->id;
                $subarray['person_id']=$actor->person_id;
                $subarray['character_id']=$actor->character_id;
                $subarray['character']=$actor->character->name;
                $subarray['name']=$actor->person->full_name;
                $actors[] = $subarray;
            }
        }
        // return (array)$actors;

        $crewmembers = $project->crewmembers
                        ->map(function ($crewmember) {
                            $array['crewtype'] = $crewmember->crewtype->name;
                            $array['sort_order'] = $crewmember->crewtype->sort_order ?? (1000 + $crewmember->id);
                            $array['last_name'] = $crewmember->person->last_name;
                            $array['first_name'] = $crewmember->person->first_name;
                            $array['person_id'] = $crewmember->person->id;
                            $array['id'] = $crewmember->id;
                            $array['portrait'] = $crewmember->person->portraits[0]['file_name'] ?? null;
                            return $array;
                        })
                        ->sortBy('sort_order')
                        ->values();

        // return $crewmembers;
        // return $project;
        return view('test.show', Compact('project', 'actors', 'crewmembers'));
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
