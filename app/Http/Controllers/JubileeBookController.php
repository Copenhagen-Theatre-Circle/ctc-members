<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\JubileeBookAnswer;
use App\Project;
use App\Projectmemory;
use App\Photograph;
use App\Essaytopic;
use App\Essaytopicanswer;
use App\JubileeSidebar;

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
        if (is_array($decades)) { $jubileeEntry->decades = implode(';', $decades);} else { $jubileeEntry->decades = '';}
        if (is_array($series)) { $jubileeEntry->series = implode(';', $series);} else { $jubileeEntry->series = '';}
        if (is_array($essays)) { $jubileeEntry->essays = implode(';', $essays);} else { $jubileeEntry->essays = '';}
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
        $sidebar = new JubileeSidebar($person_id);
        $sidebardata = $sidebar->generate();
        $person = Person::where('uniqid',$person_id)->first();
        return view ('jubilee_book/step_3_index',Compact('person','sidebardata'));
    }

    public function step_3_show($person_id, $show_id)
    {
        //show gets redirected to edit
        return redirect('jubilee-book/'.$person_id.'/step-3/'.$show_id . '/edit');
    }

    public function step_3_edit($person_uniqid, $show_id)
    {
        $sidebar = new JubileeSidebar($person_uniqid);
        $sidebardata = $sidebar->generate();
        $person = Person::where('uniqid',$person_uniqid)->first();
        $this_project = Project::where('id',$show_id)->first();
        $projectmemory = Projectmemory::firstOrNew(['person_id'=>$person->id, 'project_id' => $this_project->id]);
        $photographs = Photograph::whereHas('phototags', function ($query) use ($this_project) {
            $query->where('project_id', $this_project->id);
            })->get();
        // return $photographs;
        return view ('jubilee_book/step_3_edit', Compact('person','sidebardata','this_project','projectmemory', 'photographs'));
    }

    public function step_3_essay_edit($person_uniqid, $essay_id)
    {
        $sidebar = new JubileeSidebar($person_uniqid);
        $sidebardata = $sidebar->generate();
        $person = Person::where('uniqid',$person_uniqid)->first();
        $this_essay = Essaytopic::where('id',$essay_id)->first();
        $essaytopicanswer = Essaytopicanswer::firstOrNew(['person_id'=>$person->id, 'essaytopic_id' => $this_essay->id]);
        $photographs = Photograph::whereHas('phototags', function ($query) use ($this_essay) {$query->where('essaytopic_id', $this_essay->id);})->get();
        return view ('jubilee_book/step_3_edit_essay', Compact('person','sidebardata','this_essay','essaytopicanswer', 'photographs'));
    }

    public function step_3_store(Request $request, $person_uniqid, $project_id)
    {
        $person = Person::where('uniqid',$person_uniqid)->first();
        $projectmemory = Projectmemory::firstOrNew(['person_id'=>$person->id, 'project_id' => $project_id]);
        $projectmemory->participation_level = $request->input('participation_level');
        $projectmemory->production_memories = $request->input('production_memories');
        $projectmemory->performance_memories = $request->input('performance_memories');
        $projectmemory->completed = $request->input('completed');
        $projectmemory->save();
        return redirect('jubilee-book/'.$person_uniqid.'/step-3/'.$project_id.'/edit');
    }

    public function step_3_essay_store(Request $request, $person_uniqid, $essay_id)
    {
        $person = Person::where('uniqid',$person_uniqid)->first();
        $essaytopicanswer = Essaytopicanswer::firstOrNew(['person_id'=>$person->id, 'essaytopic_id' => $essay_id]);
        if (is_array($request->input('answer_question_1'))) {
            $essaytopicanswer->answer_question_1 = implode (';', $request->input('answer_question_1'));
        } else {
            $essaytopicanswer->answer_question_1 = $request->input('answer_question_1');
        }
        $essaytopicanswer->answer_question_2 = $request->input('answer_question_2');
        $essaytopicanswer->answer_question_3 = $request->input('answer_question_3');
        $essaytopicanswer->answer_question_4 = $request->input('answer_question_4');
        $essaytopicanswer->completed = $request->input('completed');
        $essaytopicanswer->save();
        return redirect('jubilee-book/'.$person_uniqid.'/step-3/essays/'.$essay_id.'/edit');
    }
}
