<?php

namespace App\Http\Controllers;

use App\Userpreference;
use Illuminate\Http\Request;

class UserpreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\Userpreference  $userpreference
     * @return \Illuminate\Http\Response
     */
    public function show($uniqid) 
    {
        $person = \App\Person::where('uniqid',$uniqid)->first();
        $person_id = $person->id;
        $userpreference = Userpreference::where('person_id', $person_id)->first();
        return view ('userpreferences.show',Compact('userpreference','person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Userpreference  $userpreference
     * @return \Illuminate\Http\Response
     */
    public function edit(Userpreference $userpreference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Userpreference  $userpreference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userpreference $userpreference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Userpreference  $userpreference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userpreference $userpreference)
    {
        //
    }
}
