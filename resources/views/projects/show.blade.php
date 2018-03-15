@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$project->name}}</li>
          </ol>
        </nav>
        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-body">

                        <table class="table table-striped">

                            <tr>
                                <th style="width: 7%;"></th>
                                <th >First Name</th>
                                <th >Last Name</th>
                                <th >Last Update</th>
                                <th >can audition</th>
                                <th >mail</th>
                                <th >mobile</th>
                                {{-- <th style="width: 15%;">not available</th> --}}
                                <th></th>
                            </tr>



                            @foreach ($answers as $audition_form_answer)
                                <tr>
                                    <td><img src="https://ctc-members-balmec.imgix.net/{{$audition_form_answer->person->main_portrait()}}?fit=crop&w=123&h=123&crop=faces&facepad=1.7&fit=facearea" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; "></td>
                                    <td>{{$audition_form_answer->person->first_name}}</td>
                                    <td>{{$audition_form_answer->person->last_name}}</td>
                                    <td>{{$audition_form_answer->person->questionnaire_answered}}</td>
                                    <td>{!! nl2br($audition_form_answer->date_preferences) !!}</td>
                                    <td>{{$audition_form_answer->person->mail}}</td>
                                    <td>{{$audition_form_answer->person->mobile}}</td>
                                    {{-- <td>{{$audition_form_answer->not_available_dates}}</td> --}}
                                    <td><a href="/audition_form_answers/{{$audition_form_answer->id}}" class="btn btn-primary">Details</a></td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
