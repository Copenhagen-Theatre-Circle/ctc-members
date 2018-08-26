<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JubileeBook extends Controller
{
    public function step_1($person_id)
    {
        return view ('jubilee_book/step_1');
    }

    public function step_2($person_id)
    {
        return view ('jubilee_book/step_2');
    }

    public function step_3_index($person_id)
    {
        return view ('jubilee_book/step_3_index');
    }

    public function step_3_show($person_id, $show_id)
    {
        return view ('jubilee_book/step_3_show');
    }

    public function step_3_edit($person_id, $show_id)
    {
        return view ('jubilee_book/step_3_edit');
    }
}
