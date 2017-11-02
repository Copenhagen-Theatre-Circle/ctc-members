@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row scrollbox">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="jumbotron pt-3 pb-2">
                      <h1 class="display-5" style="animation: fadein 2s;">Welcome, {{ explode(' ',trim(Auth::user()->name))[0]}}!</h1>
                      <p class="lead">Thanks for visiting the CTC Members' Area!</p>
                      <p>The first features, like the membership list and the accounts, are set up and ready to use, but lots more is on its way!</p>
                      <p>Keep a lookout for added information in this box, where we will be introducing new features in the members' section and any other relevant news for members.</p>
                      {{-- <hr class="my-4">
                      <p class="lead">
                        <a class="btn btn-primary btn-lg" href="#" role="button">edit profile</a>
                      </p> --}}
                    </div>

                    <div class="row">

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/list-user.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Membership List</h4>
                            <p class="card-text">Browse a list of current members, plus other people who have filled in the questionnaire or who have been active in the CTC over the past 5 years.</p>
                            <a href="/membership" class="btn btn-primary">Membership</a>
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/pie-chart.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Accounts</h4>
                            <p class="card-text">Browse through the CTC's accounts and get a transparent view of how we have been spending our money, both for shows and entire seasons.</p>
                            <a href="#" class="btn btn-primary">Accounts</a>
                          </div>
                        </div>

                      </div>

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
                            <p class="card-text">Production help wanted, news from the committee, or anything else that might be of interest to members: read it on the bulletin board. Or even write your own post...</p>
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/envelope-open-letter-heart.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Suggestion Box</h4>
                            <p class="card-text">Could things in the CTC be done differently? Want to suggest a new activity? Let the committee know in the suggestion box.</p>
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                        <div class="card">
                          <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;" src="media/book.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Production Handbook</h4>
                            <p class="card-text">Years of experience in theatre-making has been written down in our production handbook. Want to learn more about Production Management. Read on here...</p>
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
