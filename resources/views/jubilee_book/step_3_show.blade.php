@extends('layouts.app_simple_bulma')

@section('title','CTC Jubilee Book')

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
                                        Instructions for Step 3
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="column">
                    <h3 class="title is-3">{{$this_project->name}}</h3>
                    <h4 class="subtitle is-4">{{$this_project->year}}</h4>
                    <hr>

                    @if ($projectmemory->participation_level)
                    <h5 class="title is-5">What was your level of participation in this show (cast, crew, audience, other)?</h5>
                    <p>{{$projectmemory->participation_level}}</p>
                    <hr>
                    @endif

                    @if ($projectmemory->production_memories)
                    <br>
                    <h5 class="title is-5">What do you remember most about putting this production together? Why did we choose to do this show? What was it like backstage? What were some challenges the production faced?</h5>
                    <p>{{$projectmemory->production_memories}}</p>
                    <hr>
                    @endif

                    @if ($projectmemory->performance_memories)
                    <br>
                    <h5 class="title is-5">What do you remember most about the performance(s)? Do any particular performers, scenes, songs, etc. stand out to you now and why? How did you feel on opening night? What about on closing night?</h5>
                    <p>{{$projectmemory->performance_memories}}</p>
                    <hr>
                    @endif

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

