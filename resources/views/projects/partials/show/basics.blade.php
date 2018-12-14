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
            Director:
        </td>
        <td>
            Blabla
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            Synopsis:
        </td>
        <td>
            @foreach($project->projects_plays as $projects_play)
                {!!nl2br($projects_play->synopsis_programme)!!}
            @endforeach
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            Director's Statement:
        </td>
        <td>
            @foreach($project->projects_plays as $projects_play)
                {!!nl2br($projects_play->directors_statement)!!}
            @endforeach
        </td>
    </tr>


</table>

<div v-show="mode=='edit'">
    @include('projects.partials.edit.basics')
</div>
