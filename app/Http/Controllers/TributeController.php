<?php

namespace App\Http\Controllers;

use App\Person;
use App\Tribute;
use Illuminate\Http\Request;

class TributeController extends Controller
{
    public function show($slug)
    {

        $person = Person::where('slug',$slug)->first();
        $tributes = Tribute::where('person_id__deceased', $person->id)->get();
        $tributes->load('tribute_from');
        return view('tributes.show', Compact('person', 'tributes'));
    }
}
