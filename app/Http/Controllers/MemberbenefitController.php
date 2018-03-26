<?php

namespace App\Http\Controllers;

use App\Memberbenefit;
use Illuminate\Http\Request;

class MemberbenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benefits = Memberbenefit::with('memberbenefitgroup')->get();
        foreach($benefits as $benefit) {
          // $array[]=$benefit;
            $array[$benefit->memberbenefitgroup->id]['groupname']=$benefit->memberbenefitgroup->name;
            $array[$benefit->memberbenefitgroup->id]['benefits'][$benefit->id]['name']=$benefit->name;
            $array[$benefit->memberbenefitgroup->id]['benefits'][$benefit->id]['sort_order']=$benefit->sort_order;
            $array[$benefit->memberbenefitgroup->id]['benefits'][$benefit->id]['member']=$benefit->member;
            $array[$benefit->memberbenefitgroup->id]['benefits'][$benefit->id]['member_comment']=$benefit->member_comment;
            $array[$benefit->memberbenefitgroup->id]['benefits'][$benefit->id]['non_member']=$benefit->non_member;
            $array[$benefit->memberbenefitgroup->id]['benefits'][$benefit->id]['non_member_comment']=$benefit->non_member_comment;
        }
        return view ('memberbenefits.index', Compact('array'));
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
     * @param  \App\Memberbenefit  $Memberbenefit
     * @return \Illuminate\Http\Response
     */
    public function show(Memberbenefit $Memberbenefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memberbenefit  $Memberbenefit
     * @return \Illuminate\Http\Response
     */
    public function edit(Memberbenefit $Memberbenefit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memberbenefit  $Memberbenefit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memberbenefit $Memberbenefit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memberbenefit  $Memberbenefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memberbenefit $Memberbenefit)
    {
        //
    }
}
