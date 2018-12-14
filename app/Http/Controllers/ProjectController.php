<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Venue;
use App\Person;
use App\Season;
use App\Project;
use App\Character;
use App\Hyperlink;
use App\ProjectsPlay;
use App\Hyperlinktype;
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
        $projects = Project::where('accounting_only',null)->orderBy('date_start','desc')->get();
        return view('projects.index', compact('projects'));
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
        return $_POST;
        return redirect('projects');
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
                  ->where('person_id',auth_person())
                  ->get();

        // return $rights;

        $project->load(
            'projects_plays.play.author_play.author',
            'projects_plays.characters',
            'projects_plays.actors.character',
            'projects_plays.actors.person',
            'projects_plays.crewmembers.crewtype',
            'projects_plays.crewmembers.person',
            'videos.hyperlinktype',
            'projectmemories'
        );

        // return $project;

        if (count($rights)>0) {
          $project->load('audition_form_answers.person');
        }
        $all_authors = array();
        foreach ($project->projects_plays as $play) {
            foreach ($play->play->author_play as $author_play) {
                $all_authors[] = $author_play->author->full_name;
            }
        }
        // return $all_authors;

        // return $project;

        $hyperlinktypes = Hyperlinktype::all();

        // panel array

        $panels = array();

        $panels = [
                'basics' => [
                    'name' => 'Basics',
                    'icon' => 'fas fa-align-justify'
                ],
                'cast' => [
                    'name' => 'Cast',
                    'icon' => 'fas fa-theater-masks'
                ],
                'crew' => [
                    'name' => 'Crew',
                    'icon' => 'fas fa-people-carry'
                ],
                'pictures' => [
                    'name' => 'Pictures',
                    'icon' => 'fas fa-images'
                ],
                'documents' => [
                    'name' => 'Documents',
                    'icon' => 'fas fa-file'
                ],
                'videos' => [
                    'name' => 'Videos',
                    'icon' => 'fas fa-video'
                ],
                // 'ticketstats' => [
                //     'name' => 'Ticket Stats',
                //     'icon' => 'fas fa-ticket-alt'
                // ],
                'testimonies' => [
                    'name' => 'Testimonies',
                    'icon' => 'fas fa-book'
                ],
            ];


        $answers = AuditionFormAnswer::with('person');
        $sort = $request->input('sort');
        if ($sort == 'first_name') {
            $answers = $answers->orderByJoin('person.first_name');
        } elseif ($sort == 'last_name') {
            $answers = $answers->orderByJoin('person.last_name');
        } elseif ($sort == 'last_update') {
            $answers = $answers->orderBy('created_at');
        }
        $answers = $answers->where('project_id',$project->id);
        $answers = $answers->get();

        $people = Person::orderBy('last_name')->get();
        $seasons = Season::orderBy('year_start', 'desc')->get();
        $venues = Venue::get();
        // return $venues;
        // return $people;

        return view('projects.show', compact('project','answers', 'panels', 'people', 'hyperlinktypes', 'all_authors', 'seasons', 'venues'));
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
        // return $_POST;
        $project_id = $request->input('project_id');

        // update cast
        if ($request->input('projects_plays') !== null) {
            foreach ($request->input('projects_plays') as $projects_play_id => $projects_play) {
                // return $projects_play;
                if ($projects_play['new_cast'] !== null) {
                    // return $projects_play['new_cast'];
                    foreach ($projects_play['new_cast'] as $new_cast) {
                        // return $new_cast['character'];
                        //create character if string
                        if (is_numeric($new_cast['character'])) {
                            $character_id = $new_cast['character'];
                        } else {
                            $projects_play = ProjectsPlay::where('id',$projects_play_id)->first();
                            $play_id = $projects_play->play_id;
                            $max_sort = Character::where('play_id', $play_id)->max('sort_value') ?? 0;
                            $character = new Character;
                            $character->play_id = $play_id;
                            $character->name = $new_cast['character'];
                            $character->sort_value = $max_sort + 1;
                            $character->save();
                            $character_id = $character->id;
                        }
                        // create person if string
                        if (is_numeric($new_cast['person'])) {
                            $person_id = $new_cast['person'];
                        } else {
                            $person = new Person;
                            $person->first_name = split_name($new_cast['person'])[0];
                            $person->last_name = split_name($new_cast['person'])[1];
                            $person->save();
                            $person_id = $person->id;
                        }
                        // store actor
                        $max_sort = Actor::where('projects_play_id', $projects_play_id)->max('sort_value') ?? 0;
                        $actor = new Actor;
                        $actor->projects_play_id = $projects_play_id;
                        $actor->character_id = $character_id;
                        $actor->person_id = $person_id;
                        $actor->sort_value = $max_sort;
                        $actor->save();
                        // return $actor->id;
                    }
                }
            }
        }

        //update project details
        $project->year = $request->input('year');
        $project->number_of_performances = $request->input('number_of_performances');
        $project->date_start = $request->input('date_start');
        $project->date_end = $request->input('date_end');
        $project->season_id = $request->input('season_id');
        $project->venue_id = $request->input('venue_id');
        $project->publish_online = $request->input('publish_online');
        $project->publish_members = $request->input('publish_members');
        $project->publish_book = $request->input('publish_book');
        $project->save();


        //store videos
        if ($request->input('new_videos')!==null) {
            foreach ($request->input('new_videos') as $video) {
                // return $video['url'];
                $hyperlink = new Hyperlink;
                $hyperlink->project_id = $project_id;
                $hyperlink->url = $video['url'];
                $hyperlink->hyperlinktype_id = $video['hyperlinktype_id'];
                $hyperlink->name = $video['name'];
                $hyperlink->author = $video['author'];
                $hyperlink->publish_online = $video['publish_online'];
                $hyperlink->publish_members = $video['publish_members'];
                $hyperlink->save();
            }
        }
        return redirect('projects/' . $project_id);
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
