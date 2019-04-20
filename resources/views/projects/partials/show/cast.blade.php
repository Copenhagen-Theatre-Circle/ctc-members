@foreach ($project->projects_plays as $project_play)
@if(count($project->projects_plays)>1)
    <h5 class="title is-4" style="padding-top:20px;"><u>{{$project_play->play->title}}</u></h5>
@endif
<table class="table is-striped is-bordered" id='actor_{{$project_play->id}}'>
    @foreach ($project_play->actors as $actor)
    <tr
    {{-- v-for="(actor, key) in actors" --}}
    >
        <td class="hidden-xs-down" style="width: 60px; padding:2px;">
          @if (count($actor->person->portraits)>0)
            @foreach ($actor->person->portraits as $portrait)
            <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$portrait->file_name}}" style="object-fit: cover; height: 55px; width: 55px; ">
            @break
            @endforeach
          @else
            <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/unisex_silhouette.png" style="object-fit: cover; height: 55px; width: 55px; ">
          @endif
        </td>
        <td>{{$actor->character->name}}</td>
        <td><a href="/people/{{$actor->person_id}}">{{$actor->person->full_name }}</a></td>
        <td v-if="mode=='edit'" style="width: 50px;"><button @click.prevent="deleteActor({{$project_play->id}}, {{$actor->id}}, {{$loop->iteration}})" class="button is-danger is-pulled-right">delete</button></td>
    </tr>
    @endforeach
    {{-- add new cast member --}}
    <tr v-for="(new_castmember, index) in new_castmembers_{{$project_play->id}}" v-show="mode=='edit'" style="height: 65px;">
        <td class="has-text-centered hidden-xs-down"><i class="fas fa-plus"></i></td>
        <td>
            <div class="control" style="min-width: 200px;">
                <select :name="'projects_plays[{{$project_play->id}}][new_cast][' + index + '][character]'" class="js-basic-single" required>
                  <option></option>
                  @foreach($project_play->characters as $character)
                      <option value={{$character->id}}>{{$character->name}}</option>
                  @endforeach
                </select>
            </div>
        </td>
        <td>
            <div class="control" style="min-width: 200px;">
                <select :name="'projects_plays[{{$project_play->id}}][new_cast][' + index + '][person]'" class="js-basic-single" required>
                  <option></option>
                  @foreach($people as $person)
                      <option value={{$person->id}}>{{$person->first_name}} {{$person->last_name}}</option>
                  @endforeach
                </select>
            </div>
        </td>
        <td v-if="mode=='edit'" style="width: 50px;"><button @click.prevent="deleteNewActor({{$project_play->id}}, index)" class="button is-danger is-pulled-right">delete</button></td>
    </tr>
</table>
<a v-show="mode=='edit'" class="button is-medium" v-on:click="addCastMember({{$project_play->id}})" class="help">+ add cast member</a>
<br>
@endforeach
<div class="columns">
  <div class="column">
    <div v-show="mode=='edit'" style="padding-top: 10px;">
      <label class="checkbox">
        <input type="checkbox" name="cast_is_complete" value=1 @if($project->cast_is_complete) checked @endif>
        all cast members have been entered
      </label>
    </div>
  </div>
  <div class="column">
    <button v-show="mode=='edit'" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button>
  </div>
</div>
<div v-show="mode=='edit'" style="height: 200px;"></div>


