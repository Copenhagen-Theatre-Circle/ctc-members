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
                            <p>You are now set up to enter your memories for your individual shows.
                            <p> <span class="icon"> <i class="fas fa-arrow-left"></i> </span> Your shows are are listed on the menu to the left. By clicking on each individual show, you can enter your thoughts and recollections.</p>
                            <p> <span class="icon has-text-danger"> <i class="fas fa-exclamation-triangle"></i> </span> You do not need to complete your notes for the show in any specific order, and you can return to this form at any time to complete it. </p>
                            <p>The icon next to each show indicates the level of completion:</p>
                            <ul>
                                <li>The <span class="icon has-text-danger"> <i class="fas fa-times-circle"></i> </span> symbol indicates that you have not yet written any text for this show.</li>
                                <li>The <span class="icon has-text-warning"> <i class="fas fa-pencil-alt"></i> </span> symbol indicates that you have written some text, but that you haven't yet marked your entry as complete (i.e. it is still work in progress).</li>
                                <li>The <span class="icon has-text-success"> <i class="fas fa-check-circle"></i> </span> symbol indicates that you have finished writing your thoughts and recollections about this show.</li>
                            </ul>
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

