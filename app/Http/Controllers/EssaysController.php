<?php

namespace App\Http\Controllers;

use App\Phototype;
use App\Essaytopic;
use App\Documenttype;
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

        $phototags = $essay->phototags;
        $phototags->load('photograph.phototype');
        // return $phototags;
        foreach ($phototags as $phototag) {
            if ($phototag->photograph->phototype) {
                $type = strtolower(str_replace(' ', '_', $phototag->photograph->phototype->name));
            } else {
                $type = 'show_still';
            }
            $filename = $phototag->photograph->file_name;
            $photographs[$type][]=$filename;
        }
        $documents = $essay->documents;
        $documents_array=array();
        foreach ($documents as $document) {
            $type = strtolower(str_replace(' ', '_', $document->documenttype->name));
            $subarray['file_name'] = $document->file_name;
            $subarray['original_file_name'] = $document->original_file_name;
            $documents_array[$type][]=$subarray;
        }
        $documents = $documents_array;


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

        $phototypes = Phototype::get();
        $documenttypes = Documenttype::get();


        return view('essays.show', Compact('essay', 'panels', 'photographs', 'phototypes', 'documents', 'documenttypes'));
    }
}
