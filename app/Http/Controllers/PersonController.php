<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $initial = Person::with('questionnaire_answers')->find($id);

        $reformed = array();
        $reformed['id']=$initial->id;
        $reformed['first_name']=$initial->first_name;
        $reformed['last_name']=$initial->last_name;
        $reformed['biography']=$initial->member_bio;
        $reformed['portrait']=$initial->portrait;

        foreach ($initial->questionnaire_answers as $answer) {

          if (!empty($answer->functiongroup_id)) {

            $sort_id = $answer->functiongroups->sort_order;

            $reformed['general_interests'][$sort_id]['name'] = $answer->functiongroups->questionnaire_name;
            $reformed['general_interests'][$sort_id]['color_hex'] = $answer->functiongroups->color_hex;

          }

          elseif (!empty($answer->function_id) && !empty($answer->has_experience) && $answer->interest==1) {

            $sort_id = $answer->functions->functiongroups->sort_order . "_" . $answer->functions->sort_order;
            $reformed['experience'][$sort_id]['name'] = $answer->functions->questionnaire_name;
            $reformed['experience'][$sort_id]['color_hex'] = $answer->functions->functiongroups->color_hex;

          }

          elseif (!empty($answer->function_id) && !empty($answer->wants_to_learn) && $answer->interest==1) {

            $sort_id = $answer->functions->functiongroups->sort_order . "_" . $answer->functions->sort_order;
            $reformed['wants_to_learn'][$sort_id]['name'] = $answer->functions->questionnaire_name;
            $reformed['wants_to_learn'][$sort_id]['color_hex'] = $answer->functions->functiongroups->color_hex;

          }

        }

        $reformed['general_interests']=array_values($reformed['general_interests']);
        $reformed['wants_to_learn']=array_values($reformed['wants_to_learn']);
        $reformed['experience']=array_values($reformed['experience']);

        return view('memberprofile')->with($reformed);

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
