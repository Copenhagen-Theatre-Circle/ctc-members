@foreach ($project->projects_plays as $project_play)
<table class="table is-bordered is-fullwidth" style="margin-bottom: 200px;">
    @foreach ($project_play->actors as $actor)
    <tr>
        <td></td>
        <td>{{$actor->person->first_name}} {{$actor->person->last_name}}</td>
        <td>{{$actor->character->name}}</td>
    </tr>
    @endforeach
    <tr style="height: 50px;">
        <td class="has-text-centered"><i class="fas fa-plus"></i></td>
        <td>
            <div class="control">
                <select name="new_cast[]" class="js-basic-single" required>
                  <option></option>
                  @foreach($people as $person)
                      <option value={{$person->id}}>{{$person->first_name}} {{$person->last_name}}</option>
                  @endforeach
                </select>
            </div>
        </td>
        <td>
            <div class="control">
                <select name="new_cast_character[]" class="js-basic-single" required>
                  <option></option>
                  @foreach($project_play->characters as $character)
                      <option value={{$character->id}}>{{$character->name}}</option>
                  @endforeach
                </select>
            </div>
        </td>
    </tr>
</table>
@endforeach

<br>
<button type="submit">Submit</button>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-basic-single').select2({
        tags: true
    });
});
</script>
