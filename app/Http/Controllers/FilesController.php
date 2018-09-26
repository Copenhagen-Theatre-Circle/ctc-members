<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator;
use Image;
use Input;
use App\Phototag;
use App\Photograph;

class FilesController extends Controller
{
    public function create() {
        return view('file_uploader_test');
    }

    public function uploadFile(Request $request){

        //enter file into photographs table
        $photo = new Photograph;
        $photo->uploader_person_id = $request->input('person_id');
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $photo->file_name = $filename;
        $photo->original_file_name = $request->file('file')->getClientOriginalName();
        $photo->save();

        //enter file into phototags table (tag project)
        $phototag = new Phototag;
        $phototag->photograph_id = $photo->id;
        $phototag->project_id = $request->input('project_id');
        $phototag->save();

        //save original file
        $request->file('file')->storeAs('public/originals', $filename );

        //save thumbnail
        $thumbnailable_formats = array ( 'jpg', 'jpeg', 'png', 'gif', 'bmp' );
        if ( in_array($extension, $thumbnailable_formats ) ) {
            $img = Image::make($request->file('file'));
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(storage_path('app/public/thumbs/' . $filename));
        }

        // $img->save(storage_path('app/public/images/' . $photo->id . '.jpg'));


        // $img->save('bar.jpg');
        // return $img;
        // return $file;
        // $request->file->store('picture');

        // $validator = Validator::make(
        //     ['file' => $file],
        //     ['file' => 'required|mimes:jpeg,jpg,gif,png']
        // );

        // if($validator->passes()){
        //     Storage::disk('public')->put('images', $file);
        //     return 'File uploaded successfully.';
        // }else{
        //     return response()->json([
        //         'success' => false,
        //         'errors' => $validator->getMessageBag()->toArray(),
        //     ], 422);
        // }
    }
}
