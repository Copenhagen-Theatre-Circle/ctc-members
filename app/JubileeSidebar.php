<?php

use App\Person;
use App\Project;
use App\Projectmemory;
use App\Essaytopic;
use App\Essaytopicanswer;
use App\JubileeBookAnswer;
namespace App;

class JubileeSidebar
{
    private $person_uniqid;

    public function __construct ($person_uniqid)
    {
        $this->person_uniqid = $person_uniqid;
    }

    public function generate () {

        $person = Person::where('uniqid',$this->person_uniqid)->first();

        //projects
        $project_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('shows')->first());
        $projects = Project::whereIn('id',$project_ids)->orderBy('year')->get();
        $new_project_array = array();
        foreach ($projects as $project) {
            $projectmemory = Projectmemory::where('person_id',$person->id)->where('project_id',$project->id)->first();
            $project->completion = $projectmemory->completion ?? 'empty';
            $new_project_array[]=$project;
        }
        $array['shows'] = $new_project_array;

        //series
        $series_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('series')->first());
        $series = Essaytopic::whereIn('id',$series_ids)->get();
        $new_series_array = array();
        foreach ($series as $serie) {
            $essaytopicanswer = Essaytopicanswer::where('person_id',$person->id)->where('essaytopic_id',$serie->id)->first();
            $serie->completion = $essaytopicanswer->completion ?? 'empty';
            $new_series_array[]=$serie;
        }
        $array['series'] = $new_series_array;

        //essays
        $essay_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('essays')->first());
        $essays = Essaytopic::whereIn('id',$essay_ids)->get();
        $new_essays_array = array();
        foreach ($essays as $essay) {
            $essaytopicanswer = Essaytopicanswer::where('person_id',$person->id)->where('essaytopic_id',$essay->id)->first();
            $essay->completion = $essaytopicanswer->completion ?? 'empty';
            $new_essays_array[]=$essay;
        }
        $array['essays'] = $new_essays_array;

        return $array;

    }

}
