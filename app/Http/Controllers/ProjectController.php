<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Venue;
use App\Person;
use App\Season;
use App\Project;
use App\Crewtype;
use App\Character;
use App\Hyperlink;
use App\Phototype;
use App\Crewmember;
use App\Documenttype;
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
        $projects = Project::where('publish_online',1)->orderBy('year','desc')->orderBy('date_start','desc')->get();
        $projects->load('documents');
        $projects->load('phototags.photograph');
        // return $projects;
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
            'phototags.photograph.phototype',
            'videos.hyperlinktype',
            'projectmemories',
            'directors.person'
        );

        $directors = array();

        foreach ($project->directors as $director) {
            $directors[]=$director->person->full_name;
        }

        $directors = implode(', ', $directors);

        $actors = array();
        foreach ($project->projects_plays as $projects_play) {
            foreach ($projects_play->actors as $actor) {
                $actors[$actor->id]['person_id']=$actor->person_id;
                $actors[$actor->id]['character_id']=$actor->character_id;
                $actors[$actor->id]['character']=$actor->character->name;
                $actors[$actor->id]['name']=$actor->person->full_name;
                $actors[$actor->id]['portrait']=$actor->person->portraits[0]['file_name'] ?? "unisex_silhouette.png";
            }
        }

        $crewmembers = $project->crewmembers
                        ->map(function ($crewmember) {
                            $array['crewtype'] = $crewmember->crewtype->name;
                            $array['sort_order'] = $crewmember->crewtype->sort_order ?? (1000 + $crewmember->id);
                            $array['last_name'] = $crewmember->person->last_name;
                            $array['first_name'] = $crewmember->person->first_name;
                            $array['person_id'] = $crewmember->person->id;
                            $array['id'] = $crewmember->id;
                            $array['portrait'] = $crewmember->person->portraits[0]['file_name'] ?? "unisex_silhouette.png";
                            return $array;
                        })
                        ->sortBy('sort_order')
                        ->values();

        $phototags = $project->phototags;

        foreach ($phototags as $phototag) {
            $type = strtolower(str_replace(' ', '_', $phototag->photograph->phototype->name));
            $filename = $phototag->photograph->file_name;
            $photographs[$type][]=$filename;
        }

        $documents = $project->documents;
        $documents_array=array();
        foreach ($documents as $document) {
            $type = strtolower(str_replace(' ', '_', $document->documenttype->name));
            $subarray['file_name'] = $document->file_name;
            $subarray['original_file_name'] = $document->original_file_name;
            $documents_array[$type][]=$subarray;
        }

        $documents = $documents_array;

        // return $documents_array;


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
                'videos' => [
                    'name' => 'Videos',
                    'icon' => 'fas fa-video'
                ],
                // 'ticketstats' => [
                //     'name' => 'Ticket Stats',
                //     'icon' => 'fas fa-ticket-alt'
                // ],
                'pictures' => [
                    'name' => 'Pictures',
                    'icon' => 'fas fa-images'
                ],
                'documents' => [
                    'name' => 'Documents',
                    'icon' => 'fas fa-file'
                ],
                'testimonies' =>[
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
        $crewtypes = Crewtype::get();
        $phototypes = Phototype::get();
        $documenttypes = Documenttype::get();
        // return $phototypes;
        // return $venues;
        // return $people;
        // return $crewmembers;
        return view('projects.show', compact('project','answers', 'panels', 'people', 'hyperlinktypes', 'all_authors', 'seasons', 'venues', 'crewmembers', 'actors', 'crewtypes', 'photographs', 'phototypes', 'documents', 'documenttypes', 'directors'));
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
                if ($projects_play['new_cast'] ?? null !== null) {
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

        if ($request->input('new_crew') !== null) {
            // return $projects_play['new_cast'];
            foreach ($request->input('new_crew') as $new_crew) {
                //crewtype is always string
                $crewtype_id = $new_crew['crewtype'];
                // create person if string
                if (is_numeric($new_crew['person'])) {
                    $person_id = $new_crew['person'];
                } else {
                    $person = new Person;
                    $person->first_name = split_name($new_crew['person'])[0];
                    $person->last_name = split_name($new_crew['person'])[1];
                    $person->save();
                    $person_id = $person->id;
                }
                // store crewmember
                $crewmember = new Crewmember;
                $crewmember->project_id = $project_id;
                $crewmember->crewtype_id = $crewtype_id;
                $crewmember->person_id = $person_id;
                $crewmember->save();
                // return $actor->id;
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
                $hyperlink->hyperlinktype_id = $video['hyperlinktype_id'] ?? null;
                $hyperlink->name = $video['name'] ?? null;
                $hyperlink->author = $video['author'] ?? null;
                $hyperlink->publish_online = $video['publish_online'] ?? null;
                $hyperlink->publish_members = $video['publish_members'] ?? null;
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
