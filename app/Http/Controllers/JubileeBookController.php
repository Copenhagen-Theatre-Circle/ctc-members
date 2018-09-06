<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\JubileeBookAnswer;
use App\Project;
use App\Projectmemory;
use App\Essaytopic;
use App\Essaytopicanswer;

class JubileeBookController extends Controller
{
    public function step_1($person_id)
    {
        $person = Person::where('uniqid',$person_id)->first();
        $jubilee_book_answer = JubileeBookAnswer::where('person_id',$person->id)->first();
        if ($jubilee_book_answer){
                $decades_selected = explode(';', $jubilee_book_answer->decades);
                $series_selected = explode(';', $jubilee_book_answer->series);
                $essays_selected = explode(';', $jubilee_book_answer->essays);
            } else {
                $decades_selected = array();
                $series_selected = array();
                $essays_selected = array();
            }
        $decades_selectable = array('1969-1978','1979-1988','1989-1998','1999-2008','2009-2018');
        $series = Essaytopic::where('type','series')->get();
        $essaytopics = Essaytopic::where('type','essays')->get();
        // return $decades;
        // return $person;
        return view ('jubilee_book/step_1', Compact('person','decades_selected','series_selected','essays_selected','decades_selectable','series','essaytopics'));
    }

    public function step_1_store(Request $request, $person_uniqid)
    {
        $decades = $request->input('decades');
        $series = $request->input('series');
        $essays = $request->input('essays');
        $person_id = Person::where('uniqid',$person_uniqid)->pluck('id')->first();
        $jubileeEntry = JubileeBookAnswer::firstOrNew(['person_id' => $person_id]);
        $jubileeEntry->decades = implode(';', $decades);
        $jubileeEntry->series = implode(';', $series);
        $jubileeEntry->essays = implode(';', $essays);
        $jubileeEntry->person_id = $person_id;
        $jubileeEntry->save();
        return redirect('jubilee-book/'.$person_uniqid.'/step-2');
    }

    public function step_2($person_id)
    {
        $person = Person::where('uniqid',$person_id)->first();
        $jubilee_book_answer = JubileeBookAnswer::where('person_id',$person->id)->first();
        if ($jubilee_book_answer){
                $decades_selected = explode(';', $jubilee_book_answer->decades);
                $shows_selected = explode(';', $jubilee_book_answer->shows);
            } else {
                $decades_selected = array();
                $shows_selected = array();
            }
        $projects = Project::where('publish_book_flag',1)->whereIn('decade', $decades_selected)->orderBy('year')->get();
        return view ('jubilee_book/step_2', Compact('person','projects','shows_selected'));
    }

    public function step_2_store(Request $request, $person_uniqid)
    {
        $shows = implode(';',$request->input('shows'));
        // return $shows;
        $person_id = Person::where('uniqid',$person_uniqid)->pluck('id')->first();
        // return $person_id;
        $jubileeEntry = JubileeBookAnswer::where('person_id', $person_id)->update(['shows'=>$shows]);
        return redirect('jubilee-book/'.$person_uniqid.'/step-3');
    }

    public function step_3_index($person_id)
    {
        $person = Person::where('uniqid',$person_id)->first();

        $project_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('shows')->first());
        $projects = Project::whereIn('id',$project_ids)->orderBy('year')->get();

        $series_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('series')->first());
        $series = Essaytopic::whereIn('id',$series_ids)->get();

        $essay_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('essays')->first());
        $essays = Essaytopic::whereIn('id',$essay_ids)->get();

        //completion status is added to each project here
        foreach ($projects as $project) {
            $projectmemory = Projectmemory::where('person_id',$person->id)->where('project_id',$project->id)->first();
            if ($projectmemory and $projectmemory->completed == 1) {
                $project->completion = "complete";
            } elseif ($projectmemory and ($projectmemory->participation_level or $projectmemory->production_memories or $projectmemory->performance_memories)){
                $project->completion = "in progress";
            } else {
                $project->completion = "empty";
            }
            $new_project_array[]=$project;
        }

        $projects = $new_project_array;
        return view ('jubilee_book/step_3_index',Compact('person','projects','series','essays'));
    }

    public function step_3_show($person_id, $show_id)
    {
        //show gets redirected to edit
        return redirect('jubilee-book/'.$person_id.'/step-3/'.$show_id . '/edit');
        //actual show view disabled
        // $person = Person::where('uniqid',$person_id)->first();
        // $project_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('shows')->first());
        // $projects = Project::whereIn('id',$project_ids)->orderBy('year')->get();
        // $this_project = Project::where('id',$show_id)->first();
        // $projectmemory = Projectmemory::where('person_id',$person->id)->where('project_id',$this_project->id)->first();
        // if (empty($projectmemory)){
        //     return redirect('jubilee-book/'.$person_id.'/step-3/'.$this_project->id . '/edit');
        // } else {
        //     return view ('jubilee_book/step_3_show', Compact('person','projects','this_project','projectmemory'));
        // }
    }

    public function step_3_edit($person_uniqid, $show_id)
    {
        $person = Person::where('uniqid',$person_uniqid)->first();
        $project_ids = explode (';',JubileeBookAnswer::where('person_id',$person->id)->pluck('shows')->first());
        $projects = Project::whereIn('id',$project_ids)->orderBy('year')->get();
        //completion status is added to each project here
        foreach ($projects as $project) {
            $projectmemory = Projectmemory::where('person_id',$person->id)->where('project_id',$project->id)->first();
            if ($projectmemory and $projectmemory->completed == 1) {
                $project->completion = "complete";
            } elseif ($projectmemory and ($projectmemory->participation_level or $projectmemory->production_memories or $projectmemory->performance_memories)){
                $project->completion = "in progress";
            } else {
                $project->completion = "empty";
            }
            $new_project_array[]=$project;
        }
        $projects = $new_project_array;
        $this_project = Project::where('id',$show_id)->first();
        $projectmemory = Projectmemory::firstOrCreate(['person_id'=>$person->id, 'project_id' => $this_project->id]);
        return view ('jubilee_book/step_3_edit', Compact('person','projects','this_project','projectmemory'));
    }

    public function step_3_store(Request $request, $person_uniqid, $project_id)
    {
        $person = Person::where('uniqid',$person_uniqid)->first();
        $projectmemory = Projectmemory::where('person_id',$person->id)->where('project_id',$project_id)->first();
        $projectmemory->participation_level = $request->input('participation_level');
        $projectmemory->production_memories = $request->input('production_memories');
        $projectmemory->performance_memories = $request->input('performance_memories');
        $projectmemory->completed = $request->input('completed');
        $projectmemory->save();
        return redirect('jubilee-book/'.$person_uniqid.'/step-3/'.$project_id.'/edit');
    }
}
