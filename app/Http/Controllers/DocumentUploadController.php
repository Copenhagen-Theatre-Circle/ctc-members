<?php

namespace App\Http\Controllers;

use Image;
use Input;
use Storage;
use Validator;
use App\Document;
use Illuminate\Http\Request;

class DocumentUploadController extends Controller
{
    public function store(Request $request){

        //enter file into documents table
        $document = new Document;
        $document->person_id__uploader = $request->input('uploader_person_id');
        $document->documenttype_id = $request->input('documenttype_id');
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $document->file_name = $filename;
        $document->original_file_name = $request->file('file')->getClientOriginalName();
        $document->save();

        //save original file
        move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $filename);

    }
}





