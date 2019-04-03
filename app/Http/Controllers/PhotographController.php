<?php

namespace App\Http\Controllers;

use App\Person;
use App\Project;
use App\Phototag;
use App\Phototype;
use App\Photograph;
use Illuminate\Http\Request;

class PhotographController extends Controller
{
    public function show($filename)
    {
        $photograph = Photograph::where('file_name',$filename)->first();
        $phototags_people = Phototag::select('id','person_id')->where('photograph_id',$photograph->id)->where('person_id','<>',null)
                                    ->with(['person' => function ($q) {
                                            $q->select('id','first_name','last_name');
                                    }])
                            ->get();
        $phototag_project = Phototag::select('id','project_id')->where('photograph_id',$photograph->id)->where('project_id','<>',null)->first() ?? (object)[];
        // $photograph = $photograph->except('id','file_name','phototype_id','is_tagged','uploader_person_id','photographer_person_id');
        $photograph->load('photographer','uploader');
        $phototypes = Phototype::select('id','name')->get();
        $projects = Project::select('id','name')->where('accounting_only',null)->orWhere('accounting_only',0)->orderBy('name')->get();
        $people = Person::select('id','first_name','last_name')->orderBy('first_name')->orderBy('last_name')->get();

        return view('photographs.show', Compact('photograph','phototag_project','phototags_people','phototypes','projects','people'));
    }

    public function update(Request $request, Photograph $photograph)
    {
        // return $_POST;
        $photograph->fill($request->except('id','file_name'))->save();
        return $photograph->only('id','file_name','phototype_id','is_tagged','photographer_person_id');
    }

    public function destroy($id)
    {
        $photograph = Photograph::find($id);
        $file_name = $photograph->file_name;
        Phototag::where('photograph_id',$id)->delete();
        Photograph::destroy($id);
        unlink('files/'.$file_name);
        return 'ok';
    }
}
