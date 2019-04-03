<?php

namespace App\Http\Controllers;

use App\Person;
use App\Phototag;
use Illuminate\Http\Request;

class PhototagController extends Controller
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
        $input = $request->input();

        //create person if not yet set
        if (!isset($input['person']['id']) and isset($input['person']['full_name'])) {
            $full_name = $input['person']['full_name'];
            $first_name = split_name($full_name)[0];
            $last_name = split_name($full_name)[1];
            $person = Person::firstOrCreate(['first_name'=>$first_name, 'last_Name'=>$last_name]);
            $person_id = $person->id;
        } else {
            $person_id = $input['person']['id'] ?? null;
        }

        $phototag = new Phototag;
        $phototag->person_id = $person_id;
        $phototag->photograph_id = $input['photograph']['id'];
        $phototag->project_id = $input['projectTag']['project_id'] ?? null;
        $phototag->save();
        return $phototag
        ->load(['person' => function ($q) {
            $q->select('id','first_name','last_name');
        }]);
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
        // only projects can get updated (people get destroyed and recreated)
        $input = $request->input();
        $phototag = Phototag::find($id);
        $phototag->photograph_id = $input['photograph']['id'];
        $phototag->project_id = $input['projectTag']['project_id'];
        $phototag->save();
        return $phototag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Phototag::destroy($id);
        return 'ok';
    }
}
