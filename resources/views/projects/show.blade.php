@extends('layouts.app')

@section('content')

    <div class="container py-3">
        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">
                <div class="card light-transparency">
                    <div class="card-header">
                        <h5>Audition Form Responses: {{$project->name}}</h5>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped">

                            <tr>
                                <th style="width: 7%;"></th>
                                <th style="width: 15%;">First Name</th>
                                <th style="width: 15%;">Last Name</th>
                                <th></th>
                            </tr>



                            @foreach ($project->audition_form_answers as $audition_form_answer)
                                <tr>
                                    <td ><img src="https://ctc-members-balmec.imgix.net/{{$audition_form_answer->person->main_portrait()}}?fit=crop&w=123&h=123&crop=faces&facepad=1.7&fit=facearea" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; "></td>
                                    <td class="pt-3">{{$audition_form_answer->person->first_name}}</td>
                                    <td class="pt-3">{{$audition_form_answer->person->last_name}}</td>
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
