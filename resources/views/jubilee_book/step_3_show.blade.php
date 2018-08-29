@extends('layouts.app_simple_bulma')

@section('content')

<div class="container">

  @include('jubilee_book/navbar')

  <div class="section" style="padding: 10px; padding-top: 20px;">
    @include ('jubilee_book/step_counter', ['step'=>3])

    <section class="section" style="padding: 0px; padding-top: 0px;">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-3">
                        <nav class="menu">
                            <p class="menu-label">
                                Select a Show
                            </p>
                            <ul class="menu-list">
                                @foreach ($projects as $project)
                                    <li>
                                        <a href="{{$project->id}}" @if ($project->id == $this_project->id) class='is-active' @endif >
                                            <span class="icon @if ($project->id != $this_project->id) has-text-success @endif ">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            {{$project->name}}
                                        </a>
                                    </li>
                                @endforeach
                                <hr>
                                <li>
                                    <a href="../step-3">
                                        <span class="icon">
                                            <i class="fas fa-align-justify"></i>
                                        </span>
                                        instructions step 3
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="column">
                    <h3 class="title is-3">{{$this_project->name}}</h3>
                    <h4 class="subtitle is-4">{{$this_project->year}}</h4>
                    <p> Bla bla bla here </p>
                    <br>
                    <a href='{{$this_project->id}}/edit' class="button is-danger is-pulled-left">
                        <span class="icon">
                            <i class="fas fa-pencil-alt"></i>
                        </span>
                        &nbsp; edit
                    </a>
                    <br>
                </div>
                </div>
            </div>
        </div>
    </section>
  </div>

</div>

@endsection

