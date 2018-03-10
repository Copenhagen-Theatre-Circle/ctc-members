<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Person;
use App\Crewfunction;
use App\Mail\ContactMessage;

class GroupMessageController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user_id = \Auth::user()->id;
      $user_model = User::find($user_id);
      $user_person_id = $user_model->person->id;
      $user = Person::find($user_person_id);
      $functions = Crewfunction::get()->sortBy('sort_order')->sortBy('FunctionGroupSortOrder');
      foreach ($functions as $function) {
        $functionarray[$function->functiongroup][$function->id]=$function->questionnaire_name;
      }
      return view('groupmessageform',['user'=>$user, 'crewfunctions'=>$functionarray]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return Response::json($_POST);
        $crewfunctions = $_POST['crewfunction'];
        $experience = $_POST['experience'];

        $people = Person::select('first_name','last_name','mail')
                  ->whereHas('questionnaire_answers', function ($query) use ($crewfunctions, $experience) {
                      // $query->Where('function_id', $crewfunctions[0]);
                      $query->where( function ($query) use ($crewfunctions, $experience){
                        $query->where('function_id', $crewfunctions[0]);
                        if($experience=="experience"){
                          $query->where('has_experience', 1);
                        } elseif ($experience=="learn") {
                          $query->where('wants_to_learn', 1);
                        }
                      } );
                      foreach ($crewfunctions as $crewfunction) {
                        // $query->orWhere('function_id', $crewfunction);
                        $query->orWhere( function ($query) use ($crewfunction, $experience) {
                          $query->where('function_id', $crewfunction);
                          if($experience=="experience"){
                            $query->where('has_experience', 1);
                          } elseif ($experience=="learn") {
                            $query->where('wants_to_learn', 1);
                          }
                        });
                      }
                  })->get();

        $count = count ($people);

        foreach ($people as $to_person) {
          $from_person = Person::find(request('id_from'));
          $name_to = $to_person->first_name . ' ' . $to_person->last_name;
          // $mail_to = $to_person->mail;
          $mail_to = "andrew@blackwell.dk";
          $name_from = $from_person->first_name . ' ' . $from_person->last_name;
          $mail_from = $from_person->mail;
          $subject = $request->subject;
          $body = $request->body;
          $body = str_replace('<<FIRST_NAME>>', $to_person->first_name, $body);
          $attributes = ['fromName' => $name_from, 'replyTo' => $mail_from, 'subject' => $subject, 'body' => $body];
          Mail::to($mail_to)->send(new ContactMessage($attributes));
        }

        return redirect('message/confirmation');
        return array ($mail_from, $mail_to, $subject, $body);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
