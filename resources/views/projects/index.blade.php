@extends('layouts.master')

@section('title','CTCDB+')

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li class="is-active"><a href="#">CTCDB+</a></li>
    @if (user_can_edit_ctcdb())
        <a class="button is-small is-danger is-outlined" href="https://trello.com/b/XHtATnxU/ctcdb" target="_blank" style="margin-left: 65%;">report bugs / feature requests (Trello)</a>
    @endif

@endsection

@section('content')

    <div class="section" id="projects" style="padding-top: 10px; padding-left: 0px; padding-right: 0px;">

        <div class="columns" style="margin-bottom: 0px; padding-left: 10px; padding-right: 10px; ">
            <div class="column is-5 is-offset-1">
                <input class="input search" type="text" placeholder="Search projects" />
            </div>
        </div>

        <table class="table is-striped is-bordered is-fullwidth">

            <thead>
                <th></th>
                <th><span class="sort" data-sort="name">Project Name</span></th>
                <th>Season</th>
                <th>Show Starts</th>
                <th>Show Ends</th>
                @if (user_can_edit_ctcdb())
                    <th><span class="sort" data-sort="programme">Programme</span></th>
                @endif
                <th></th>
            </thead>
            <tbody class="list">

            @foreach ($projects as $project)
                <tr>
                    <td>
                        @foreach ($project->phototags as $phototag)
                            @if($phototag->photograph->phototype_id == 3)
                                <img src="https://res.cloudinary.com/ctcircle/image/fetch/w_70/https://ctc-members.dk/files/{{$phototag->photograph->file_name}}">
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td class="pt-3 name">{{$project->name}}</td>
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
                        <td class="has-text-centered programme">
                            @foreach ($project->documents as $document)
                                @if($document->documenttype_id == 1) <i class="fas fa-check" style="color: green"></i>@break @endif
                            @endforeach
                        </td>
                    @endif
                    <td><a href="/projects/{{$project->id}}" class="button btn-primary">Details</a></td>
                </tr>
            @endforeach
        </tbody>
        </table>

    </div>

@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
<script type="text/javascript">
    var options = {
      valueNames: [ 'name', 'programme']
    };
    var projectsList = new List('projects', options);
</script>

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
