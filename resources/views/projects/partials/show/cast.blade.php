@foreach ($project->projects_plays as $project_play)
<table class="table is-striped is-bordered is-fullwidth">
{{--     <tr>
        <th></th>
        <th>Actor</th>
        <th>Character</th>

    </tr> --}}
    @foreach ($project_play->actors as $actor)
    <tr>
        <td class="hidden-xs-down" style="width: 60px; padding:2px;">
        @if (!empty($actor->person->portraits[0]))
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$actor->person->portraits[0]['file_name']}}" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        @else
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_50/https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        @endif
        </td>
        <td><a href="/people/{{$actor->person->id}}">{{$actor->person->first_name}} {{$actor->person->last_name}}</a></td>
        <td>{{$actor->character->name}}</td>
    </tr>
    @endforeach
</table>
@endforeach
