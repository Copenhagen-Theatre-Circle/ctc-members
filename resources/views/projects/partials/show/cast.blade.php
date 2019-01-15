@foreach ($project->projects_plays as $project_play)

<table class="table is-striped is-bordered">
    {{-- @foreach ($project_play->actors as $actor) --}}
    <tr v-for="(actor, key) in actors">
        <td class="hidden-xs-down" style="width: 60px; padding:2px;">
          <img :src="'https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/' + actor.portrait " style="object-fit: cover; height: 55px; width: 55px; ">
        </td>
        <td>@{{ actor.character }}</td>
        <td><a href="/people/{{$actor->person->id ?? ''}}">@{{ actor.name }}</a></td>
        <td v-if="mode=='edit'" style="width: 50px;"><button @click.prevent="deleteActor(key)" class="button is-danger is-pulled-right">delete</button></td>
    </tr>
    {{-- @endforeach --}}
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
        <td v-if="mode=='edit'" style="width: 50px;"><button @click.prevent="deleteNewActor(index)" class="button is-danger is-pulled-right">delete</button></td>
    </tr>
</table>
<a v-show="mode=='edit'" class="button is-medium" @click="addCastMember" class="help">+ add cast member</a>
<button v-show="mode=='edit'" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button>
<div v-show="mode=='edit'" style="height: 200px;"></div>
@endforeach

