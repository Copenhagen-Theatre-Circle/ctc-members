<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Crewfunction;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $person = Person::find($user->person->id);
        if (!$person->is_committee_member){
            return redirect('/');
        }
        $slug = $request->input('function') ?? 'pr';
        $function = Crewfunction::where('slug',$slug)->first();
        $function_id = $function->id;
        $people = Person::whereHas('questionnaire_answers', function ($q) use ($function_id) {
            return $q->where('function_id',$function_id);
        })
        ->with(['questionnaire_answers' => function ($q) use ($function_id){
            return $q->where('function_id',$function_id);
        }])
        ->orderBy('last_name')
        ->orderBy('first_name')
        ->get();
        $array = $people->map(function($person){
            $response['last_name'] = $person->last_name;
            $response['first_name'] = $person->first_name;
            $response['email'] = $person->mail;
            foreach($person->questionnaire_answers as $answer){
                if($answer->has_experience==1){
                    $response['experience']='experience';
                } else {
                    $response['experience']='interest';
                }
                if ($answer->updated_at){
                    $response['last_answered']=$answer->updated_at->format('Y-m-d');
                }
            }
            return $response;
        });

        $functions = Crewfunction::orderBy('questionnaire_name')->get();

        return view('help',compact('array','functions','function_id'));
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
        //
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
