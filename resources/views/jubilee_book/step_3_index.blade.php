@extends('layouts.app_simple_bulma')

@section('content')

<div class="container">

  @include('jubilee_book/navbar')

  <div class="section" style="padding: 10px; padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>3])

     <section class="section" style="padding: 0px;">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-3">
                        <nav class="menu">
                            <p class="menu-label">
                                Select a Show:
                            </p>
                            <ul class="menu-list">
                                @foreach ($projects as $project)
                                    <li>
                                        <a href="step-3/{{$project->id}}">
                                            <span class="icon has-text-success">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            {{$project->name}}
                                        </a>
                                    </li>
                                @endforeach
                                <hr>
                                <li>
                                    <a href="/jubilee-book/{{$person->uniqid}}/step-2">
                                        <span class="icon">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                        back to step 2
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="column">
                        <div class="content">
                            <p>Thanks for selecting your active years and your shows.</p>
                            <p>You are now set up to enter your memories for your individual shows.</p>
                            <hr>
                            <div class="columns">
                                <div class="column is-narrow has-text-centered">
                                    <span class="icon" style="margin-top:1rem;margin-left: 1rem;"> <i class="fas fa-arrow-left fa-2x"></i> </span>
                                </div>
                                <div class="column">
                                    <p> Your shows are are listed on the menu to the left.<br>By clicking on each individual show, you can enter your thoughts and recollections for each show.</p>
                                </div>
                            </div>
                            <hr>
                            <div class="columns">
                                <div class="column is-narrow">
                                    <span class="icon" style="margin-top:0.5rem;margin-left: 1rem;"> <i class="fas fa-info-circle fa-2x"></i> </span>
                                </div>
                                <hr>
                                <div class="column">
                                    Please note that:
                                    <ul style="margin-top: 0; margin-left: 1rem;">
                                        <li>you do not need to complete your notes for the show in any specific order.</li>
                                        <li>you can return to this form at any time to complete it. </li>
                                    </ul>
                                    <p>The icon next to each show indicates the level of completion:</p>
                                    <span class="icon has-text-danger fa-lg"> <i class="fas fa-times-circle"></i> </span>&nbsp; indicates that you have not yet written any text for this show.
                                    <br>
                                    <br>
                                    <span class="icon has-text-warning fa-lg"> <i class="fas fa-pencil-alt"></i> </span>&nbsp; indicates that you have written something but not yet marked your entry as complete (i.e. it is still work in progress).
                                    <br>
                                    <br>
                                    <span class="icon has-text-success fa-lg"> <i class="fas fa-check-circle"></i> </span>&nbsp; indicates that you have finished writing your thoughts and recollections about this show.
                                        </div>
                            </div>

                            <hr>
                            <p>Happy Recollections!</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>

  </div>


</div>



@endsection

