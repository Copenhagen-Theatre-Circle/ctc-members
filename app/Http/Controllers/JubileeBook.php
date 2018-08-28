<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\JubileeBookAnswer;
use App\Project;

class JubileeBook extends Controller
{
    public function step_1($person_id)
    {
        $person = Person::where('uniqid',$person_id)->first();
        $jubilee_book_answer = JubileeBookAnswer::where('person_id',$person->id)->first();
        if ($jubilee_book_answer){
                $decades_selected = explode(';', $jubilee_book_answer->decades);
            } else {
                $decades_selected = array();
            }
        $decades_selectable = array('1968-1978','1979-1988','1989-1998','1999-2008','2009-2018');
        // return $decades;
        // return $person;
        return view ('jubilee_book/step_1', Compact('person','decades_selected','decades_selectable'));
    }

    public function step_1_store(Request $request, $person_uniqid)
    {
        $decade = $request->input('decade');
        $person_id = Person::where('uniqid',$person_uniqid)->pluck('id')->first();
        // return $person_id;
        $jubileeEntry = JubileeBookAnswer::firstOrNew(['person_id' => $person_id]);
        $jubileeEntry->decades = implode(';', $decade);
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
        return view ('jubilee_book/step_3_index',Compact('person'));
    }

    public function step_3_show($person_id, $show_id)
    {
        return view ('jubilee_book/step_3_show');
    }

    public function step_3_edit($person_id, $show_id)
    {
        return view ('jubilee_book/step_3_edit');
    }
}
