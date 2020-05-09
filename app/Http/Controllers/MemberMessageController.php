<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Person;
use App\Crewfunction;
use App\Mail\ContactMessage;
use App\Settings;

class MemberMessageController extends Controller
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
      return view('membermessageform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $_POST;

        $people = Person::select('first_name','last_name','mail','uniqid')
                  ->whereHas('memberships', function ($q) {
                    $q->where('season_id', Settings::find(1)->active_season_id);
                  })->get();

        // return $people;
        // $count = count ($people);
        // return $count;

        foreach ($people as $to_person) {
          $from_person = Person::find(request('id_from'));
          $name_to = $to_person->first_name . ' ' . $to_person->last_name;
          $mail_to = $to_person->mail;
          // $mail_to = "membership@ctcircle.dk";
          $bcc = "andrew@blackwell.dk";
          $name_from = $from_person->first_name . ' ' . $from_person->last_name;
          $mail_from = $from_person->mail;
          $subject = $request->subject;
          $body = $request->body;
          $body = str_replace('<<FIRST_NAME>>', $to_person->first_name, $body);
          $link = 'https://ctc-members.dk/questionnaire/index.php?p=' . $to_person->uniqid;
          $body = str_replace('<<QUESTIONNAIRE_LINK>>', $link, $body);
          $attributes = ['fromName' => $name_from, 'replyTo' => $mail_from, 'subject' => $subject, 'body' => $body, 'bcc' => $bcc];
          Mail::to($mail_to)->send(new ContactMessage($attributes));
        }

        return redirect('message/confirmation?origin=home');

        // return array ($count, $people);

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
