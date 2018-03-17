<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AuditionFormAnswer;
use App\Exports\AuditionsExport;
use Excel;

class ExportController extends Controller
{

  public function auditions($project_id, Request $request) {

    $sort = $request->input('sort');

    return Excel::download(new AuditionsExport($project_id, $sort), 'audition_answers.xlsx');

  }

}
