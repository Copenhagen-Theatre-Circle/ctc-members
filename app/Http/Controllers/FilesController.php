<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator;

class FilesController extends Controller
{
    public function create() {
        return view('file_uploader_test');

    }

    public function uploadFile(Request $request){

        // return $request;
        $file = $request->file('file');
        // return $file;
        // $request->file->store('picture');

        $validator = Validator::make(
            ['file' => $file],
            ['file' => 'required|mimes:jpeg,jpg,gif,png']
        );

        if($validator->passes()){
            Storage::disk('public')->put($file->getClientOriginalName(), $file);
            return 'File uploaded successfully.';
        }else{
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ], 422);
        }
    }
}
