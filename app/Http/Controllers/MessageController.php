<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Person;
use App\User;
use App\Mail\ContactMessage;

class MessageController extends Controller
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
      $id = request('u');
      $recipient = Person::find($id);
      return view('contactform',['recipient' => $recipient]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $to_person = Person::find(request('id_to'));
        $from_person = Person::find(request('id_from'));
        $name_to = $to_person->first_name . ' ' . $to_person->last_name;
        $mail_to = $to_person->mail;
        $name_from = $from_person->first_name . ' ' . $from_person->last_name;
        $mail_from = $from_person->mail;
        $subject = $request->subject;
        $body = $request->body;
        $attributes = ['fromName' => $name_from, 'replyTo' => $mail_from, 'subject' => $subject, 'body' => $body];
        Mail::to($mail_to)->send(new ContactMessage($attributes));
        return redirect('message/confirmation');
        // return array ($mail_from, $mail_to, $subject, $body);
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
