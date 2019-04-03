<!DOCTYPE html>
<html>
<head>
	<title>Testing Vue</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
  <style type="text/css">
    .vs__selected-options {
      width: 300px !important;
    }
  </style>
</head>
<body>
  <div id="app" class="container section">

    <h1 class="heading is-size-2">@{{project.name}}</h1>
    <br>

    {{-- Basics --}}
    <h2 class="heading is-size-3">BASICS</h2>
    <h2>Plays</h2>
    <v-select :options="plays" label="title" v-model="playInput" taggable></v-select>
    <br>
    @{{playInput.title}}  @{{playInput.id}}
    <br>
    <br>
    <h2>Persons</h2>
    <v-select :options="people" label="full_name" taggable v-model="personInput"></v-select>
    <br>
    @{{personInput.full_name}}  @{{personInput.id}}
    <br>
    <br>
    <div v-for="play in project.projects_plays">
      <h2 class="heading is-size-4" v-if="hasSeveralPlays">
        @{{play.play.title}}
      </h2>
      <p>@{{play.synopsis_programme}}</p>
      <br>
      <div v-if="play.directors_statement">
        <h3 class="heading is-size-5">
          Director's Statement
        </h3>
        <p>@{{play.directors_statement}}</p>
        <br>
      </div>
    </div>
    <br>

    {{-- Cast --}}
    <h2 class="heading is-size-3">CAST</h2>
    <br>
    <div v-for="play, key in project.projects_plays">
      <h2 class="heading is-size-4" v-if="hasSeveralPlays">
        @{{play.play.title}}
      </h2>
      <br v-if="hasSeveralPlays">
      <table class="table is-bordered is-striped">
        <tr v-for="actor in play.actors">
          <td>@{{actor.character.name}}</td>
          <td>@{{actor.person.first_name}} @{{actor.person.last_name}}</td>
        </tr>
      </table>
      <button class="button" @click="addActor(key)">add Actor</button>
      <br>
      <br>
    </div>

    {{-- CREW --}}
    <h2 class="heading is-size-3">CREW</h2>
    <br>

    {{-- if only one project --}}
    <div v-if="!hasSeveralPlays">
      <table class="table is-bordered is-striped">
          <tr v-for="crewmember in project.crewmembers">
            <td>@{{crewmember.crewtype.name}}</td>
            <td>@{{crewmember.person.first_name}} @{{crewmember.person.last_name}}</td>
          </tr>
      </table>
    </div>

    {{-- if several projects --}}
    <div v-if="hasSeveralPlays">
      <div v-for="play in project.projects_plays">
        <h2 class="heading is-size-4">
          @{{play.play.title}}
        </h2>
        <br>
        <table class="table is-bordered is-striped">
          <tr v-for="crewmember in play.crewmembers">
            <td>@{{crewmember.crewtype.name}}</td>
            <td>@{{crewmember.person.first_name}} @{{crewmember.person.last_name}}</td>
          </tr>
        </table>
        <br>
      </div>
      <h3 class="heading is-size-4" v-if="hasSeveralPlays">Production Crew</h3>
      <br>
      <table class="table is-bordered is-striped">
          <tr v-for="crewmember in project.crewmembers" v-if="!crewmember.projects_play_id">
            <td>@{{crewmember.crewtype.name}}</td>
            <td>@{{crewmember.person.first_name}} @{{crewmember.person.last_name}}</td>
          </tr>
      </table>
    </div>
    <br>

  </div>


<script src="https://unpkg.com/vue@latest"></script>
<script src="https://unpkg.com/vue-select@latest"></script>


<script type="text/javascript">
  Vue.component('v-select', VueSelect.VueSelect);
	var app = new Vue({
	  el: '#app',
	  data: {
	    project: {!! json_encode($project) !!},
      plays: {!! json_encode($plays) !!},
      playInput: '',
      people: {!! json_encode($people) !!},
      personInput: '',
	  },
    computed: {
      hasSeveralPlays: function (){
        return this.project.projects_plays.length > 1
      },
    },
    methods: {
      addActor: function(key){
        this.project.projects_plays[key].actors.push(
          {
            "id":390,"character_id":306,"person_id":166,"projects_play_id":65,"sort_value":null,"created_at":null,"updated_at":null,
            "character":{
              "name":"Lady Catherine de Bourgh","sex":null
              },
            "person":{
              "id":166,"first_name":"Kat","last_name":"J\u00f8rgensen","member_bio":null,"obituary":null
            }
          }
          )
      }
    }
	});
</script>

</body>
</html>
