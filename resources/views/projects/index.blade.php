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
            <div class="column">
                <input v-model="showFilter" class="input search" type="text" placeholder="Search projects" />
            </div>
            @if (user_can_edit_ctcdb())
                <div class="column" style="padding-top: 15px;">
                    <label class="checkbox">
                      <input v-model="bookOnly" type="checkbox">
                      display only productions featured in the book
                    </label>
                </div>
                <div class="column" style="padding-top: 15px;">
                    <label class="checkbox">
                      <input v-model="mineOnly" type="checkbox">
                      display only productions attributed to me
                    </label>
                </div>
            @endif
        </div>

        <table class="table is-striped is-bordered is-fullwidth">

            <thead>
                <th></th>
                <th><span class="sort" data-sort="name">Project Name</span></th>
                <th>Season</th>
                @if (user_can_edit_ctcdb())
                    <th><span class="sort" data-sort="programme"><i class="fas fa-book"></i></span></th>
                    <th><span class="sort" data-sort="programme"><i class="fas fa-book-reader"></i></span></th>
                    <th><span class="sort" data-sort="programme"><i class="fas fa-theater-masks"></i></i></span></th>
                    <th><span class="sort" data-sort="programme"><i class="fas fa-people-carry"></i></span></th>
                    <th><span class="sort" data-sort="programme"><i class="fas fa-images"></i></span></th>
                    <th><span class="sort" data-sort="programme">data&nbsp;entry</span></th>
                @else
                    <th>Show Starts</th>
                    <th>Show Ends</th>
                @endif
                <th></th>
            </thead>
            <tbody class="list">

            @foreach ($projects as $project)
                <tr v-if=
                "
                (
                    ((bookOnly == true) && ({{$project->publish_book ?? 0}}==1))
                    ||
                    bookOnly == false
                )
                &&
                (
                    showFilter == ''
                    ||
                    (showFilter !== '' && '{{str_replace("'", "", $project->name)}}'.toLowerCase().includes(showFilter.toLowerCase()))
                    {{-- ('{{$project->name}}'.includes(showFilter)) --}}
                )
                &&
                (
                    mineOnly == false
                    ||
                    (myId == '{{$project->dataentryperson->id ?? ''}}')
                )
                ">
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
                    @if (user_can_edit_ctcdb())
                        <td>
                            @if($project->publish_book)
                                <i class="fas fa-circle" style="color: #D4AF37"></i>
                            @endif
                        </td>
                        <td class="has-text-centered programme">
                            @foreach ($project->documents as $document)
                                @if($document->documenttype_id == 1) <i class="fas fa-check" style="color: green"></i>@break @endif
                            @endforeach
                        </td>
                        <td>
                            @if($project->cast_is_complete)
                                <i class="fas fa-check" style="color: green"></i>
                            @endif
                        </td>
                        <td>
                            @if($project->crew_is_complete)
                                <i class="fas fa-check" style="color: green"></i>
                            @endif
                        </td>
                        <td>
                            {{count($project->showpics)}}&nbsp;/&nbsp;{{count($project->backstagepics)}}
                        </td>
                        <td>
                            @if ($project->dataentryperson)
                                {{$project->dataentryperson->first_name}}
                            @endif
                        </td>
                    @else
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
    var vue = new Vue ({
        el: '#app',
        data: {
            bookOnly: false,
            showFilter: '',
            mineOnly: false,
            myId: {{$user}}
        }
    })
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
