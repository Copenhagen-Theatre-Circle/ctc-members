@extends('layouts.master')

@section('title','50th Jubilee Book')

@section('content')

  <div class="section" style="padding: 10px; padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>3])

     <section class="section" style="padding: 0px;">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-3 has-background-white-bis">
                        @include('jubilee_book/sidebar', ['person' => $person, 'sidebardata' => $sidebardata, 'type' => 'index', 'id'=>''])
                    </div>
                    <div class="column" style="padding-left:2rem;padding-right:2rem;">
                        <div class="content">
                            <p>Thanks for selecting your active years and your shows.</p>
                            <p>You are now set up to enter your memories for your individual shows.</p>
                            <br>
                            <div class="columns">
                                <div class="column is-narrow">
                                    <span class="icon" style="margin-top:1rem; margin-left: 0.3rem;"> <i class="fas fa-arrow-left fa-2x"></i> </span>
                                </div>
                                <div class="column">
                                    <p> Your shows, series and essay topics (if chosen) are are listed on the menu to the left.<br>By clicking on each individual show, you can enter your thoughts and recollections for each show.</p>
                                </div>
                            </div>
                            <br>
                            <div class="columns">
                                <div class="column is-narrow">
                                    <span class="icon" style="margin-top:0.5rem; margin-left: 0.3rem;"> <i class="fas fa-info-circle fa-2x"></i> </span>
                                </div>
                                <hr>
                                <div class="column">
                                    Please note that:
                                    <ul style="margin-top: 0; margin-left: 1rem;">
                                        <li>you do not need to complete your notes for the show in any specific order.</li>
                                        <li>you can return to this form at any time to complete it. </li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <p>The icon next to each show indicates the level of completion:</p>
                            <span class="icon has-text-danger fa-lg"> <i class="fas fa-times-circle"></i> </span>&nbsp; indicates that you have not yet written any text for this show.
                            <br>
                            <br>
                            <span class="icon has-text-warning fa-lg"> <i class="fas fa-pencil-alt"></i> </span>&nbsp; indicates that you have written something but not yet marked your entry as complete (i.e. it is still work in progress).
                            <br>
                            <br>
                            <span class="icon has-text-success fa-lg"> <i class="fas fa-check-circle"></i> </span>&nbsp; indicates that you have finished writing your thoughts and recollections about this show.
                            <br>
                            <br>
                            <br>
                            <p>Happy Recollections!</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>

  </div>

@endsection

