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



                        <div class="jumbotron pt-3 pb-2 mb-3">

                            <h1 class="display-5" style="animation: fadein 2s;">Welcome,
                                {{ explode(' ', trim(Auth::user()->name))[0] }}!</h1>
                            <p class="lead">Thanks for visiting the CTC Members' Area!</p>
                        </div>
                        
                        <!-- Only display this section if $display_on_frontpage is true -->
                        @if ($display_on_frontpage == true)
                            <div class="jumbotron pt-3 pb-2 mb-4"
                                style="min-height: 320px;
                                    background-color: grey;
                                    background: no-repeat url('media/{{ $project->banner_image_file_name }}');
                                    background-size: cover; background-position: 0% 80%; ">
                                <div class="row">
                                    <div
                                        class="col-xs-1 col-sm-1 col-md-3 col-lg-4 @if (count($codes) > 3) col-xl-6 @else col-xl-7 @endif ">
                                    </div>
                                    <div class="col mx-3 rounded" style="background-color:rgba(0, 0, 0, 0.8);">
                                        @if (count($codes) != 0)
                                            <h4 class="text-light pt-3 mb-2">Your Rebate Codes for '{{ $project->name }}':
                                            </h4>
                                            <div @if (count($codes) > 3) style="column-count: 2" @endif
                                                class="text-light mb-2">
                                                @foreach ($codes as $code)
                                                    <p class="mb-0 @if (count($codes) < 4) lead @endif">
                                                        <b>{{ $code->code }}</b>
                                                        @if ($code->person_id != $user->person->id)
                                                            &nbsp; ({{ $code->first_name }})
                                                        @endif
                                                        @if ($code->rebate == 100)
                                                            (comp)
                                                        @endif
                                                    </p>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div style="border-bottom: 1pt solid grey; margin-bottom: 12px;"></div>
                                        <a href="https://place2book.com/en/sw2/sales/event_list/EM175" target="_blank"
                                            class="btn btn-lg btn-outline-info btn-block border-white text-white mb-3">Go To
                                            Ticket Sales Page</a>
                                        <a href="ticketsales/{{ $project->id }}" 
                                            class="btn btn-lg btn-outline-info btn-block border-white text-white mb-4">Check
                                            Ticket Sales Stats</a> 
                                    </div>
                                </div>
                            </div>
                            @endif

                        <div class="row">

                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                <div class="card">
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/list-user.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">The Network</h4>
                                        <p class="card-text">Browse a list of current members, plus other people who
                                            have filled in the questionnaire or who have been active in the CTC over the
                                            past 5 years.</p>
                                        <a href="/people" class="btn btn-primary">CTC Network</a>
                                    </div>
                                </div>

                            </div>

                            {{-- <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                <div class="card">
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/pie-chart.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Accounts</h4>
                                        <p class="card-text">Browse through the CTC's accounts and get a transparent
                                            view of how we have been spending our money, both for shows and for entire
                                            seasons.</p>
                                        <a href="http://ctc-members.dk/a6de1850-21c1-4ca2-87e0-253c61bee591/seasons/"
                                            class="btn btn-primary" target="_blank">Accounts</a>
                                    </div>
                                </div>

                            </div> --}}

                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                <div class="card">
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/red-book.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Handbooks</h4>
                                        <p class="card-text">Years of experience in theatre-making has been written
                                            down in our handbooks. Want to do production management? Read on here...</p>
                                        <a href="/handbooks" class="btn btn-primary">Handbook</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                <div class="card">
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/envelope-open-letter-heart-red.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Suggestion Box</h4>
                                        <p class="card-text">Could the CTC be doing things differently? Want to suggest
                                            a new activity? Any play you'd like to see produced? Let us know in the
                                            suggestion box.</p>
                                        <a href="/suggestions" class="btn btn-primary">Suggestions</a>
                                    </div>
                                </div>

                            </div>

                            {{-- </div>

                    <div class="row"> --}}

                            {{-- CTCDB+ --}}

                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                <div class="card">
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/monitor-arrow.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">CTCDB+</h4>
                                        <p class="card-text">Explore members-only content of the <a
                                                href="http://www.ctcdb.dk" target="_blank">ctcdb</a> (our previous shows
                                            database) such as video recordings of the show or ticket sales statistics.</p>
                                        <a href="/projects" class="btn btn-primary">Browse The Shows</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                <div class="card">
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/user-pencil.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Your Profile</h4>
                                        <p class="card-text">Change what is shown on your personal profile page on the
                                            membership list by editing your biography and interests in the personal
                                            questionnaire.</p>
                                        {{-- Edit your biography and tick off what interests you in your personal questionnaire to change what is shown about you on the membership list.</p> --}}
                                        <a href="https://ctc-members.dk/questionnaire/?p={{ $user->uniqid() }}"
                                            class="btn btn-primary" target="_blank">Edit Questionnaire</a>
                                    </div>
                                </div>

                            </div>

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
                                        <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                            src="media/group-mail.png" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Group Mail</h4>
                                            <p class="card-text">Write a mail to a group of people with specific
                                                interests</p>
                                            <a href="/groupmessage/create" class="btn btn-primary">Write Message</a>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                    <div class="card">
                                        <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                            src="media/group-mail.png" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Member Mail</h4>
                                            <p class="card-text">Write a mail to all members</p>
                                            <a href="/membermessage/create" class="btn btn-primary">Write Message</a>
                                        </div>
                                    </div>

                                </div>
                            @endif

                            {{-- Essays --}}

                            @if (user_is_jubilee_book_editor())
                                <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                    <div class="card">
                                        <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                            src="/media/book-text.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Book Essays</h4>
                                            <p class="card-text">Answers to the essay topics for the 50th Anniversary
                                                Book (book editors only)</p>
                                            <a href="/essays" class="btn btn-primary">Browse The Essays</a>
                                        </div>
                                    </div>

                                </div>
                            @endif

                            @if (count($user->person->rights) > 0)
                                <div class="col-sm-6 col-md-4 col-xl-3 mb-4">

                                    <div class="card">
                                        <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                            src="media/ticket.png" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Audition Form Responses</h4>
                                            <p class="card-text">Audition Form Responses for shows</p>
                                            <a href="/auditions" class="btn btn-primary">Form Responses</a>
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
                                    <img class="card-img-top mt-4 ml-4" style="height: 112px; width:112px;"
                                        src="media/note-pin.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Bulletin Board</h4>
                                        <p class="card-text">Production help wanted, news from the committee, or
                                            anything else that might be of interest to you: read it here. Or even write your
                                            own post...</p>
                                        {{-- <a href="/posts" class="btn btn-primary">Bulletin Board</a> --}}
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
