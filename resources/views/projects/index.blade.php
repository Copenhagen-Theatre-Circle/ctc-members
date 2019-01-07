@extends('layouts.master')

@section('title','CTCDB+')

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li class="is-active"><a href="#">CTCDB+</a></li>
@endsection

@section('content')

    <div class="section" style="padding-top: 0px; padding-left: 0px; padding-right: 0px;">
        <table class="table is-striped is-bordered is-fullwidth">

            <tr>
                <th></th>
                <th>Project Name</th>
                <th>Season</th>
                <th>Show Starts</th>
                <th>Show Ends</th>
                @if (user_can_edit_ctcdb())
                    <th>Programme</th>
                @endif
                <th></th>
            </tr>

            @foreach ($projects as $project)
                <tr>
                    <td>
                        @foreach ($project->phototags as $phototag)
                            @if($phototag->photograph->phototype_id == 3)
                                <img src="https://res.cloudinary.com/ctcircle/image/fetch/w_70/https://ctc-members.dk/files/{{$phototag->photograph->file_name}}">
                            @endif
                        @endforeach
                    </td>
                    <td class="pt-3">{{$project->name}}</td>
                    <td class="pt-3">{{$project->season->year_start}}/{{$project->season->year_start+1}}</td>
                    <td class="pt-3">
                    @if ( !empty ($project->date_start) )
                        {{date ('d M Y', strtotime($project->date_start))}}
                    @endif
                    </td>
                    <td class="pt-3">
                        @if ( !empty ($project->date_end) )
                            {{date ('d M Y', strtotime($project->date_end))}}
                        @endif
                    </td>
                    @if (user_can_edit_ctcdb())
                        <td>
                            @foreach ($project->documents as $document)
                                @if($document->documenttype_id == 1) <i class="fas fa-check" style="color: green"></i> @endif
                            @endforeach
                        </td>
                    @endif
                    <td><a href="/projects/{{$project->id}}" class="button btn-primary">Details</a></td>
                </tr>
            @endforeach

        </table>

    </div>

@endsection

{{-- @extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Projects</li>
          </ol>
        </nav>

        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">
                <div class="card light-transparency">


                    <div class="card-body">


                        <table class="table table-striped">

                            <tr>
                                <th>Project Name</th>
                                <th>Show Starts</th>
                                <th>Show Ends</th>
                                <th></th>
                            </tr>

                            @foreach ($projects as $project)
                                <tr>
                                    <td class="pt-3">{{$project->name}}</td>
                                    <td class="pt-3">
                                    @if ( !empty ($project->date_start) )
                                        {{date ('d M Y', strtotime($project->date_start))}}
                                    @endif
                                    </td>
                                    <td class="pt-3">
                                        @if ( !empty ($project->date_end) )
                                            {{date ('d M Y', strtotime($project->date_end))}}
                                        @endif
                                    </td>
                                    <td><a href="/projects/{{$project->id}}" class="btn btn-primary">Details</a></td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
 --}}
