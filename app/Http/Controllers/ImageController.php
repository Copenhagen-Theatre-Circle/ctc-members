<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;
use Response;

class ImageController extends Controller
{
    public function show ($filename)
    {
        // Add folder path here instead of storing in the database.
        // return $filename;
        $path = storage_path('app/public/originals/' . $filename);
        // $img = Image::make($path);
        // return $path;
        if (!File::exists($path)) {
            $path = storage_path('app/public/originals/document-error-flat.png');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function showThumb ($filename)
    {
        // Add folder path here instead of storing in the database.
        // return $filename;
        $path = storage_path('app/public/thumbs/' . $filename);
        // $img = Image::make($path);
        // return $path;
        if (!File::exists($path)) {
            $path = storage_path('app/public/thumbs/document-error-flat.png');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
