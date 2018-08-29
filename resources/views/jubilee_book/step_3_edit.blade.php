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
                                Your Shows:
                            </p>
                            <ul class="menu-list">
                                @foreach ($projects as $project)
                                    <li>
                                        <a @if ($project->id == $this_project->id) class='is-active' @endif style="cursor: default;">
                                            <span class="icon @if ($project->id != $this_project->id) has-text-success @endif ">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            {{$project->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <div class="column">
                    <h3 class="title is-3">{{$this_project->name}}</h3>
                    <h4 class="subtitle is-4">{{$this_project->year}}</h4>
                    <form action="{{ route ('jubilee.step3.store', [$person->uniqid,$this_project->id]) }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <button type="submit" class="button is-danger is-pulled-left">
                            <span class="icon">
                                <i class="far fa-save"></i>
                            </span>
                            &nbsp; save
                        </button>
                    </form>
                    <br>
                </div>
                </div>
            </div>
        </div>
    </section>

  </div>


</div>



@endsection

