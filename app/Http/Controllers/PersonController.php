<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Settings;
use App\Crewfunction;
use App\Functiongroup;
use App\User;
use DB;

class PersonController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('member');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $people = Person::select('first_name','last_name','id');

      $people->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');

      // scope: people who answered questionnaire or are members if special rights, else only members
      if (user_is_admin_or_superuser()){
        $people->answeredQuestionnaireOrIsMember();
      } else {
        $people->isMember();
      }

      // queries here
      // TODO: refactor this into scopes

      // query if name search

      if (!empty(request('name'))) {
        $people->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . request('name') . '%');
      }


      // query if general interest search

      if (!empty(request('g'))) {
        $people->whereHas('questionnaire_answers', function($q){
          $q->where('functiongroup_id',request('g'));
        });
      }

      // query if specific interest search

      if (!empty(request('f'))) {
        $people->whereHas('questionnaire_answers', function($q){
          $q->where(['interest'=>1,'function_id'=>request('f')]);
          if (request('e')==1) {
              $q->where(['has_experience'=>1]);
          } elseif (request('e')==2) {
              $q->where(['has_experience'=>0]);
              $q->where(['wants_to_learn'=>1]);
          }
          elseif (request('e')==3) {
              $q->where(['wants_to_learn'=>1]);
          }
        });
      }

      // query if CTC Member search

      if (request('c')==1) {
        $people->whereHas('memberships', function($q){
          $q->where('season_id',Settings::find(1)->active_season_id);
        });
      }

      if (request('c')==2) {
        $people->whereDoesntHave('memberships', function($q){
          $q->where('season_id',Settings::find(1)->active_season_id);
        });
      }

      // execute query

      $people = $people->get();

      // eager load required related data

      $people->load(
        'portraits',
        'membership_this_season',
        'questionnaire_answers'
      );

      // retrieve functiongroups and functions

      $functiongroups = Functiongroup::orderBy('sort_order')->get();
      $functiongroups->load('crewfunctions');

      // return view with data

      return view('people.index', Compact ('people', 'functiongroups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        // return $id;
        // $person = Person::where('id',$id)->first;
        $person->load(
          // 'questionnaire_answers',
          // 'roles.character',
          // 'roles.projects_play.play',
          // 'roles.projects_play.project',
          'crewjobs.crewtype',
          'crewjobs.projects_play.play',
          'crewjobs.projects_play.project',
          'crewjobs.project'
        );



      // return $person;

        $reformed = array();
        $reformed['id']=$person->id;
        $reformed['first_name']=$person->first_name;
        $reformed['last_name']=$person->last_name;
        $reformed['biography']=$person->member_bio;
        // $reformed['roles']=$person->roles;
        if(!empty($person->portraits[0])){
          $reformed['portrait']=$person->portraits[0]['file_name'];
        } else {
          $reformed['portrait']='unisex_silhouette.png';
        }

        foreach ($person->questionnaire_answers as $answer) {

          if (!empty($answer->functiongroup_id)) {

            //sort order field = key, to ensure correct order
            $sort_id = $answer->functiongroup['sort_order'];
            $reformed['general_interests'][$sort_id]['name'] = $answer->functiongroup->questionnaire_name;
            $reformed['general_interests'][$sort_id]['color_hex'] = $answer->functiongroup->color_hex;

          }

          elseif (!empty($answer->function_id) && !empty($answer->has_experience) && $answer->interest==1) {

            //sort order field = key, to ensure correct order
            $sort_id = $answer->crewfunction->functiongroup->sort_order . "_" . $answer->crewfunction->sort_order;
            $reformed['experience'][$sort_id]['name'] = $answer->crewfunction->questionnaire_name;
            $reformed['experience'][$sort_id]['color_hex'] = $answer->crewfunction->functiongroup->color_hex;

          }

          elseif (!empty($answer->function_id) && !empty($answer->wants_to_learn) && $answer->interest==1) {

            //sort order field = key, to ensure correct order
            $sort_id = $answer->crewfunction->functiongroup->sort_order . "_" . $answer->crewfunction->sort_order;
            $reformed['wants_to_learn'][$sort_id]['name'] = $answer->crewfunction->questionnaire_name;
            $reformed['wants_to_learn'][$sort_id]['color_hex'] = $answer->crewfunction->functiongroup->color_hex;

          }

        }

        foreach ($person->roles as $role) {
            $sort_order = $role->projects_play->project->date_start . "_" . $role->id;
            $reformed['roles'][$sort_order]['play']=$role->projects_play->play->title ?? '';
            $reformed['roles'][$sort_order]['character']=$role->character->name;
        }

        if (isset ($reformed['roles'])){
          ksort($reformed['roles']);
        }


        foreach ($person->crewjobs as $crewjob) {

            if (isset ($crewjob->projects_play->project->id)) {
              $id = $crewjob->projects_play->project->date_start . '_pp_'. $crewjob->projects_play->id;
              $reformed['crewjobs'][$id]['crewfunction'][] = $crewjob->crewtype->name;
              $reformed['crewjobs'][$id]['project'] = $crewjob->projects_play->play->title;
              $reformed['crewjobs'][$id]['project_id'] = $crewjob->projects_play->project_id;
            } elseif ($crewjob->project->id > 0) {
              $id = $crewjob->project->date_start . '_pr_'. $crewjob->project->id;
              $reformed['crewjobs'][$id]['crewfunction'][] = $crewjob->crewtype->name;
              $reformed['crewjobs'][$id]['project'] = $crewjob->project->name;
              $reformed['crewjobs'][$id]['project_id'] = $crewjob->project->id;
            }

        }

        if (isset ($reformed['crewjobs'])){
          ksort($reformed['crewjobs']);
        }

        //remove keys here
        if (!empty($reformed['general_interests'])) {
          $reformed['general_interests']=array_values($reformed['general_interests']);
        }

        if (!empty($reformed['wants_to_learn'])){
          $reformed['wants_to_learn']=array_values($reformed['wants_to_learn']);
        }

        if (!empty($reformed['experience'])){
          $reformed['experience']=array_values($reformed['experience']);
        }

        $person = $reformed;



        // return $person;

        return view('people.show')->with($person);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
