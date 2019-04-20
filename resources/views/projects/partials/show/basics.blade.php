<table class="table no-border" v-show="mode=='show'">
    <tr>
        <td style="vertical-align: top">
            Season:
        </td>
        <td>
            {{$project->season->year_start}}/{{$project->season->year_start+1}}
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            Performances:
        </td>
        <td>
            {{$project->number_of_performances}}
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            @if(count($project->directors) > 1)
            Directors:
            @else
            Director:
            @endif
        </td>
        <td>
            {{$directors}}
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            Synopsis:
        </td>
        <td style="padding-top: 11px;">
            @foreach($project->projects_plays as $projects_play)
                @if($projects_play->synopsis_programme)
                    @if(count($project->projects_plays)>1)
                        <h5 class="title is-6"><u>{{$projects_play->play->title}}</u></h5>
                    @endif
                    <p>
                        {!!nl2br($projects_play->synopsis_programme)!!}
                    </p>
                    <br/>
                @endif
            @endforeach
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            Director's Statement:
        </td>
        <td style="padding-top: 11px;">
            @foreach($project->projects_plays as $projects_play)
                @if($projects_play->synopsis_programme)
                    @if(count($project->projects_plays)>1)
                        <h5 class="title is-6"><u>{{$projects_play->play->title}}</u></h5>
                    @endif
                    <p>
                        {!!nl2br($projects_play->directors_statement)!!}
                    </p>
                    <br/>
                @endif
            @endforeach
        </td>
    </tr>


</table>

<div v-show="mode=='edit'">
    @include('projects.partials.edit.basics')
</div>
