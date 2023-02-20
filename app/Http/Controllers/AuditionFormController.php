<?php

namespace App\Http\Controllers;

use App\AuditionFormVariable;
use App\Mail\AuditionForm;
use App\Person;
use App\Project;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuditionFormController extends Controller
{
    public function show(Request $request)
    {
        $settings = Settings::first();
        $project_id = $request->input('project_id') ?? $settings->default_project_id_audition_form;
        $auditionFormVariables = AuditionFormVariable::where('project_id', $project_id)->first();
        //if the link does not include a valid person unique id, show the preform page
        if (!$request->has('p')) {
            return view('auditionform.preform', ['projectId' => $project_id, 'auditionFormVariables' => $auditionFormVariables]);
        }
        $person = Person::where('uniqid', $request->input('p'))->first();
        $project = Project::find($project_id);
        return [$person, $project, $auditionFormVariables];
    }

    public function store_pre(Request $request)
    {
        $person_id = lookup_or_create_person($request->input('email'), $request->input('first_name'), $request->input('last_name'));
        $person = Person::find($person_id);
        $auditionFormVariables = AuditionFormVariable::where('project_id', $request->input('project_id'))->first();
        $link = "https://ctc-members.dk/audition?p=" . $person->uniqid . "&project_id=" . $request->input('project_id');
        //send AuditionForm mail
        Mail::to('andrew@blackwell.dk')->send(new AuditionForm($person, $link));
        return view('auditionform.thank_you', ['auditionFormVariables' => $auditionFormVariables]);
        return $link;
        return 'mail sent';
        return [$person, $link];
    }
}
