<?php

namespace App\Http\Controllers;

use App\Essaytopic;
use Illuminate\Http\Request;

class EssaysController extends Controller
{
    public function index()
    {
        $essays = Essaytopic::all();
        return view ('essays.index', Compact('essays'));
    }

    public function show($id)
    {
        $essay = Essaytopic::find($id);
        $essay->load('essaytopicanswers.person');
        // return $essay;
        $panels = [
                'testimonies' => [
                    'name' => 'Testimonies',
                    'icon' => 'fas fa-align-justify'
                ],
                'pictures' => [
                    'name' => 'Pictures',
                    'icon' => 'fas fa-images'
                ],
                'documents' => [
                    'name' => 'Documents',
                    'icon' => 'fas fa-file'
                ],
            ];


        return view('essays.show', Compact('essay', 'panels'));
    }
}
