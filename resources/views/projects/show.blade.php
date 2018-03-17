@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$project->name}}</li>
            {{-- Excel download --}}
            {{-- <div class="float-right">
              <a class="btn btn-outline-success btn-sm mr-2" href="/export/auditions/{{$project->id}}?sort={{app('request')->input('sort')}}" download>Download .xlsx</a>
            </div> --}}
          </ol>
        </nav>
        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-body">

                        <table class="table table-striped">

                            <tr>
                                <th style="width: 7%;"></th>
                                <th @if (app('request')->input('sort')=="first_name")
                                    class="sorted"
                                    @endif >
                                    <a class="text-dark" href="/projects/{{$project->id}}?sort=first_name">
                                    First Name
                                    </a>
                                </th>
                                <th @if (app('request')->input('sort')=="last_name")
                                    class="sorted"
                                    @endif >
                                    <a class="text-dark" href="/projects/{{$project->id}}?sort=last_name">
                                    Last Name
                                    </a>
                                </th>
                                <th @if (app('request')->input('sort')=="last_update")
                                    class="sorted"
                                    @endif >
                                    <a class="text-dark" href="/projects/{{$project->id}}?sort=last_update">
                                    Applied
                                    </a>
                                </th>
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
                                    <td>{{date ('d M Y', strtotime($audition_form_answer->created_at))}}</td>
                                    <td>{!! nl2br($audition_form_answer->date_preferences) !!}</td>
                                    <td>{{$audition_form_answer->person->mail}}</td>
                                    <td>{{$audition_form_answer->person->mobile}}</td>
                                    {{-- <td>{{$audition_form_answer->not_available_dates}}</td> --}}
                                    <td><a href="/audition_form_answers/{{$audition_form_answer->id}}@if(!empty(app('request')->input('sort')))?sort={{app('request')->input('sort')}}@endif" class="btn btn-primary">Details</a></td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
