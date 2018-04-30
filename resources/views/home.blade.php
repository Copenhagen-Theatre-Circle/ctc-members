@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row scrollbox">
        <div class="col-md-12 col-md-offset-2">
            <div class="card light-transparency">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif



                    <div class="jumbotron pt-3 pb-2">

                      <h1 class="display-5" style="animation: fadein 2s;">Welcome, {{ explode(' ',trim(Auth::user()->name))[0]}}!</h1>
                      <p class="lead">Thanks for visiting the CTC Members' Area!</p>
                    </div>

                    <div class="row">

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/list-user.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">The Network</h4>
                            <p class="card-text">Browse a list of current members, plus other people who have filled in the questionnaire or who have been active in the CTC over the past 5 years.</p>
                            <a href="/membership" class="btn btn-primary">CTC Network</a>
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/pie-chart.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Accounts</h4>
                            <p class="card-text">Browse through the CTC's accounts and get a transparent view of how we have been spending our money, both for shows and for entire seasons.</p>
                            <a href="http://ctc-members.dk/a6de1850-21c1-4ca2-87e0-253c61bee591/seasons/" class="btn btn-primary" target="_blank">Accounts</a>
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/red-book.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Handbooks</h4>
                            <p class="card-text">Years of experience in theatre-making has been written down in our handbooks. Want to do production management? Read on here...</p>
                            <a href="/handbooks" class="btn btn-primary">Handbook</a>
                         </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/envelope-open-letter-heart-red.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Suggestion Box</h4>
                            <p class="card-text">Could the CTC be doing things differently? Want to suggest a new activity? Any play you'd like to see produced? Let us know in the suggestion box.</p>
                            <a href="/suggestions" class="btn btn-primary">Suggestions</a>
                          </div>
                        </div>

                      </div>

                    {{-- </div>

                    <div class="row"> --}}

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/user-pencil.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Your Profile</h4>
                            <p class="card-text">Change what is shown on your personal profile page on the membership list by editing your biography and interests in the personal questionnaire.</p>
                              {{-- Edit your biography and tick off what interests you in your personal questionnaire to change what is shown about you on the membership list.</p> --}}
                            <a href="https://ctc-members.dk/questionnaire/?p={{$user->uniqid()}}" class="btn btn-primary" target="_blank">Edit Questionnaire</a>
                          </div>
                        </div>

                      </div>

                      @if (count($user->person->rights)>0)

                          <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                            <div class="card">
                              <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/ticket.png" alt="Card image cap">
                              <div class="card-body">
                                <h4 class="card-title">Audition Form Responses</h4>
                                <p class="card-text">Audition Form Responses for shows</p>
                                <a href="/auditions" class="btn btn-primary">Form Responses</a>
                              </div>
                            </div>

                          </div>

                      @endif

                    </div>

                    @if (user_is_admin())

                      <div class="row pb-3">
                        <div class="col">
                          <h4>Admin only:</h4>
                        </div>
                      </div>

                    @endif

                    <div class="row">

                    @if (user_is_admin())

                        <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                          <div class="card">
                            <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/group-mail.png" alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">Group Mail</h4>
                              <p class="card-text">Write a mail to a group of people with specific interests</p>
                              <a href="/groupmessage/create" class="btn btn-primary">Write Message</a>
                            </div>
                          </div>

                        </div>

                    @endif

                    </div>

                    <div class="row pb-3">
                      <div class="col">
                        <h4>coming soon / in the pipeline:</h4>
                      </div>
                    </div>

                    <div class="row" style="color:#999;">

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/note-pin.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Bulletin Board</h4>
                            <p class="card-text">Production help wanted, news from the committee, or anything else that might be of interest to you: read it here. Or even write your own post...</p>
                            {{-- <a href="/posts" class="btn btn-primary">Bulletin Board</a> --}}
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/monitor-arrow.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">CTCDB+</h4>
                            <p class="card-text">Explore members-only content of the <a href="http://www.ctcdb.dk" target="_blank">ctcdb</a> such as video recordings of the show or ticket sales statistics.</p>
                          </div>
                        </div>

                      </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
