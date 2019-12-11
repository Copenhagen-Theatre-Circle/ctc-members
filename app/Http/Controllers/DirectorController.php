<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $person = Person::find($user->person->id);
        if (!$person->is_committee_member){
            return redirect('/');
        }
        $directorsAndWriters = Person::whereHas('questionnaire_answers', function ($q) {
            return $q->where('function_id',1)->orWhere('function_id', 33);
        })->with('directing_and_writing_questionnaire_answers')->orderBy('last_name')->orderBy('first_name')->get();
        $array = $directorsAndWriters->map(function($person){
            $response['last_name'] = $person->last_name;
            $response['first_name'] = $person->first_name;
            $response['email'] = $person->mail;
            foreach($person->directing_and_writing_questionnaire_answers as $answer){
                if ($answer->function_id==1){
                    if($answer->has_experience==1){
                        $response['directing']='experience';
                    } else {
                        $response['directing']='interest';
                    }
                } else if ($answer->function_id==33){
                    if($answer->has_experience==1){
                        $response['writing']='experience';
                    } else {
                        $response['writing']='interest';
                    }
                }
                $response['last_answered']=$answer->updated_at->format('Y-m-d');
            }
            return $response;
        });

        return view('directors',compact('array'));
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
