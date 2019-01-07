@foreach ($project->projects_plays as $project_play)
<table class="table is-striped is-bordered">
    @foreach ($project_play->actors as $actor)
    <tr>
        <td class="hidden-xs-down" style="width: 60px; padding:2px;">
        @if (!empty($actor->person->portraits[0]))
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$actor->person->portraits[0]['file_name']}}" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        @else
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_50/https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        @endif
        </td>
        <td>{{$actor->character->name ?? ''}}</td>
        <td><a href="/people/{{$actor->person->id ?? ''}}">{{$actor->person->first_name ?? ''}} {{$actor->person->last_name ?? ''}}</a></td>
        <td v-if="mode=='edit'" style="width: 50px;"><button class="button is-danger is-pulled-right">delete</button></td>
    </tr>
    @endforeach
    {{-- add new cast member --}}
    <tr v-for="(new_castmember, index) in new_castmembers" v-show="mode=='edit'" style="height: 65px;">
        <td class="has-text-centered hidden-xs-down"><i class="fas fa-plus"></i></td>
        <td>
            <div class="control">
                <select :name="'projects_plays[{{$project_play->id}}][new_cast][' + index + '][character]'" class="js-basic-single" required>
                  <option></option>
                  @foreach($project_play->characters as $character)
                      <option value={{$character->id}}>{{$character->name}}</option>
                  @endforeach
                </select>
            </div>
        </td>
        <td>
            <div class="control">
                <select :name="'projects_plays[{{$project_play->id}}][new_cast][' + index + '][person]'" class="js-basic-single" required>
                  <option></option>
                  @foreach($people as $person)
                      <option value={{$person->id}}>{{$person->first_name}} {{$person->last_name}}</option>
                  @endforeach
                </select>
            </div>
        </td>
        <td></td>
    </tr>
</table>
<a v-show="mode=='edit'" class="button is-medium" @click="addCastMember" class="help">+ add cast member</a>
<button v-show="mode=='edit'" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button>
<div v-show="mode=='edit'" style="height: 200px;"></div>
@endforeach

