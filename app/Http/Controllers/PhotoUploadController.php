<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator;
use Image;
use Input;
use App\Phototag;
use App\Photograph;

class PhotoUploadController extends Controller
{
    public function create()
    {
        return view('file_uploader_test');
    }

    public function store(Request $request)
    {

        //enter file into photographs table
        $photo = new Photograph;
        $photo->uploader_person_id = $request->input('uploader_person_id');
        $photo->phototype_id = $request->input('phototype_id');
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $photo->file_name = $filename;
        $photo->original_file_name = $request->file('file')->getClientOriginalName();
        $photo->save();

        //enter file into phototags table (tag project)
        $phototag = new Phototag;
        $phototag->photograph_id = $photo->id;
        $phototag->project_id = $request->input('project_id');
        $phototag->essaytopic_id = $request->input('essaytopic_id');
        $phototag->save();

        //save original file
        move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $filename);

        return $photo;
    }
}
