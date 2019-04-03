<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectSpaController extends Controller
{
    public function show($id, $subroute = null)
    {
        $project = Project::find($id);
        return view('projects_spa.show', Compact('project'));
    }
}
