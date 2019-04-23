@if(count($project->projects_plays)>1)
  <h5 class="title is-4" style="padding-top:20px;"><u>Overall Production Crew</u></h5>
@endif
<table class="table is-striped is-bordered" id="production_crewmembers">
  @foreach ($project->production_crewmembers as $crewmember)
  <tr>
      <td class="hidden-xs-down" style="width: 60px; padding:2px;">
        @if (count($crewmember->person->portraits)>0)
          @foreach ($crewmember->person->portraits as $portrait)
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$portrait->file_name}}" style="object-fit: cover; height: 55px; width: 55px; ">
          @break
          @endforeach
        @else
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/unisex_silhouette.png" style="object-fit: cover; height: 55px; width: 55px; ">
        @endif
      </td>
      <td>{{$crewmember->crewtype->name }}</td>
      <td>
        <a href="/people/{{$crewmember->person_id}}">{{$crewmember->person->full_name }}</a>
      </td>
      <td v-if="mode=='edit'" style="width: 50px;">
        <button class="button is-danger is-pulled-right" @click.prevent="deleteProductionCrewmember({{$crewmember->id}}, {{$loop->iteration}})">
          delete
        </button>
      </td>
  </tr>
  @endforeach
  {{-- add new crew member --}}
  <tr v-for="(new_crewmember, index) in new_production_crewmembers" v-show="mode=='edit'" style="height: 65px;">
      <td class="has-text-centered hidden-xs-down"><i class="fas fa-plus"></i></td>
      <td>
          <div class="control">
              <select :name="'new_crew[' + index + '][crewtype]'" class="js-basic-single-notags" required>
                <option></option>
                @foreach($crewtypes as $crewtype)
                    <option value={{$crewtype->id}}>{{$crewtype->name}}</option>
                @endforeach
              </select>
          </div>
      </td>
      <td>
          <div class="control">
              <select :name="'new_crew[' + index + '][person]'" class="js-basic-single" required>
                <option></option>
                @foreach($people as $person)
                    <option value={{$person->id}}>{{$person->first_name}} {{$person->last_name}}</option>
                @endforeach
              </select>
          </div>
      </td>
      <td v-if="mode=='edit'" style="width: 50px;"><button class="button is-danger is-pulled-right" @click.prevent="deleteNewProductionCrewmember(index)">delete</button></td>
  </tr>
</table>
<a v-show="mode=='edit'" class="button is-medium" v-on:click="addProductionCrewMember()" class="help">+ add crew member</a>

@if(count($project->projects_plays)>1)
  @foreach ($project->projects_plays as $project_play)
  @if(count($project->projects_plays)>1)
      <h5 class="title is-4" style="padding-top:20px;"><u>{{$project_play->play->title}}</u></h5>
  @endif
  <table class="table is-striped is-bordered" id='crewmember_{{$project_play->id}}'>
      @foreach ($project_play->crewmembers as $crewmember)
      <tr>
          <td class="hidden-xs-down" style="width: 60px; padding:2px;">
            @if (count($crewmember->person->portraits)>0)
              @foreach ($crewmember->person->portraits as $portrait)
              <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$portrait->file_name}}" style="object-fit: cover; height: 55px; width: 55px; ">
              @break
              @endforeach
            @else
              <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/unisex_silhouette.png" style="object-fit: cover; height: 55px; width: 55px; ">
            @endif
          </td>
          <td>{{$crewmember->crewtype->name }}</td>
          <td>
            <a href="/people/{{$crewmember->person_id}}">{{$crewmember->person->full_name }}</a>
          </td>
          <td v-if="mode=='edit'" style="width: 50px;">
            <button class="button is-danger is-pulled-right" @click.prevent="deleteCrewmember({{$project_play->id}}, {{$crewmember->id}}, {{$loop->iteration}})">
              delete
            </button>
          </td>
      </tr>
      @endforeach

      {{-- add new crew member --}}
      <tr v-for="(new_crewmember, index) in new_crewmembers_{{$project_play->id}}" v-show="mode=='edit'" style="height: 65px;">
          <td class="has-text-centered hidden-xs-down"><i class="fas fa-plus"></i></td>
          <td>
              <div class="control">

                  <select :name="'projects_plays[{{$project_play->id}}][new_crew][' + index + '][crewtype]'" class="js-basic-single-notags" required>
                    <option></option>
                    @foreach($crewtypes as $crewtype)
                        <option value={{$crewtype->id}}>{{$crewtype->name}}</option>
                    @endforeach
                  </select>
              </div>
          </td>
          <td>
              <div class="control">
                  <select :name="'projects_plays[{{$project_play->id}}][new_crew][' + index + '][person]'" class="js-basic-single" required>
                    <option></option>
                    @foreach($people as $person)
                        <option value={{$person->id}}>{{$person->first_name}} {{$person->last_name}}</option>
                    @endforeach
                  </select>
              </div>
          </td>
          <td v-if="mode=='edit'" style="width: 50px;"><button class="button is-danger is-pulled-right" @click.prevent="deleteNewCrewmember({{$project_play->id}}, index)">delete</button></td>
      </tr>
  </table>
  <a v-show="mode=='edit'" class="button is-medium" v-on:click="addCrewMember({{$project_play->id}})" class="help">+ add crew member</a>
  @endforeach
@endif
@if($project->special_thanks)
<div v-show="mode!=='edit'">
  <label class="label">Special Thanks</label>
  {{$project->special_thanks}}
</div>
@endif
<br>
<br>
<div v-show="mode=='edit'" class="field">
  <label class="label">Special Thanks</label>
  <div class="control">
    <textarea class="textarea" placeholder="Special Thanks" name="special_thanks">{{$project->special_thanks}}</textarea>
  </div>
</div>
<div class="columns">
  <div class="column">
    <div v-show="mode=='edit'" style="padding-top: 10px;">
      <label class="checkbox">
        <input type="checkbox" name="crew_is_complete" value=1 @if($project->crew_is_complete) checked @endif>
        all crew members have been entered
      </label>
    </div>
  </div>
  <div class="column">
    <button v-show="mode=='edit'" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button>
  </div>
</div>

<div v-show="mode=='edit'" style="height: 200px;"></div>
