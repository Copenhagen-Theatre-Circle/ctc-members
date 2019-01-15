<table class="table is-striped is-bordered">
    <tr v-for="(crewmember, key) in crewmembers">
        <td class="hidden-xs-down" style="width: 60px; padding:2px;">
            <img :src="'https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/' + crewmember.portrait" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        </td>
        <td>@{{ crewmember.crewtype }}</td>
        <td><a :href="'/people/' + crewmember.person_id">@{{ crewmember.first_name + ' ' + crewmember.last_name }}</a></td>
        <td v-if="mode=='edit'" style="width: 50px;"><button class="button is-danger is-pulled-right" @click.prevent="deleteCrewmember(crewmember.id, key)">delete</button></td>
    </tr>
{{--     @foreach ($crewmembers as $crewmember)
    <tr>
        <td class="hidden-xs-down" style="width: 60px; padding:2px;">
        @if (!empty($crewmember['portrait']))
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$crewmember['portrait']}}" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        @else
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_50/https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="object-fit: cover; height: 55px; width: 55px; ">
        @endif
        </td>
        <td>{{$crewmember['crewtype']}}</td>
        <td><a href="/people/{{$crewmember['person_id']}}">{{$crewmember['first_name']}} {{$crewmember['last_name']}}</a></td>
        <td v-if="mode=='edit'" style="width: 50px;"><button class="button is-danger is-pulled-right">delete</button></td>
    </tr>
    @endforeach --}}
    {{-- add new crew member --}}
    <tr v-for="(new_crewmember, index) in new_crewmembers" v-show="mode=='edit'" style="height: 65px;">
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
        <td v-if="mode=='edit'" style="width: 50px;"><button class="button is-danger is-pulled-right" @click.prevent="deleteNewCrewmember(index)">delete</button></td>
    </tr>
</table>
<a v-show="mode=='edit'" class="button is-medium" @click="addCrewMember" class="help">+ add crew member</a>
<button v-show="mode=='edit'" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button>
<div v-show="mode=='edit'" style="height: 200px;"></div>
