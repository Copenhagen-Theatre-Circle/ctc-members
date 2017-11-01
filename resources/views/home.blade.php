@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row">
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
                      <p>The first bits of functionality, like the membership list and the accounts, are set up and ready to use, but lots more is on its way!</p>
                      <p>Keep a lookout for added information in this box, where we will be introducing new features in the members' section and any other relevant news for members.</p>
                      {{-- <hr class="my-4">
                      <p class="lead">
                        <a class="btn btn-primary btn-lg" href="#" role="button">edit profile</a>
                      </p> --}}
                    </div>

                    <div class="row">

                      <div class="col-sm-6 col-md-4 col-xl-3">

                        <div class="card">
                          <img class="card-img-top img-fluid pl-2 pr-2 pt-2" src="media/membership.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Membership List</h4>
                            <p class="card-text">Browse a list of current members, plus other people who have filled in the questionnaire or who have been active in the CTC over the past 5 years.</p>
                            <a href="/membership" class="btn btn-primary">Membership</a>
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6 col-md-4 col-xl-3">

                        <div class="card">
                          <img class="card-img-top pl-2 pr-2 pt-2" src="media/accounts.png" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">Accounts</h4>
                            <p class="card-text">Browse through the CTC's accounts and get a nice and transparent view of how we have been spending our money.</p>
                            <a href="#" class="btn btn-primary">Accounts</a>
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
