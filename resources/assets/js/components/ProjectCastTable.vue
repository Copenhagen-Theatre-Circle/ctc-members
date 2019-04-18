<template>
    <div>
        <h1 class="title">{{projectsPlay.play.title}}</h1>
        <table class="table is-striped is-bordered">
          <tr v-for="(actor, actorKey) in projectsPlay.actors">
              <td class="hidden-xs-down" style="width: 60px; padding:2px;">
                <img
                  v-if="actor.person.portraits.length > 0"
                  :src="'https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/' + actor.person.portraits[0].file_name"
                  style="object-fit: cover; height: 55px; width: 55px; "
                  >
                <img
                  v-else
                  :src="'https://res.cloudinary.com/ctcircle/image/fetch/h_55,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/unisex_silhouette.png'"
                  style="object-fit: cover; height: 55px; width: 55px; "
                  >
              </td>
              <td>{{ actor.character.name }}</td>
              <td><a :href="'/people/' + actor.person_id">{{ actor.person.full_name }}</a></td>
              <td v-if="edit" style="width: 50px;"><button @click.prevent="deleteCastMember(actor.id, projectsPlayKey,actorKey)" class="button is-danger is-pulled-right">delete</button></td>
          </tr>
          <tr v-if="edit" style="height: 65px;">
              <td class="has-text-centered hidden-xs-down"><i class="fas fa-plus"></i></td>
              <td>
                  <v-select
                  ref="characterSelect"
                  v-model="characterEntry"
                  :options="projectsPlay.characters"
                  label="name"
                  taggable
                  :selectOnTab="true"
                  placeholder="+ new character"
                  @change="addCharacter(projectsPlay.play_id, projectsPlayKey)"
                  />
              </td>
              <td>
                  <v-select
                  ref="actorSelect"
                  v-model="personEntry"
                  :options="people"
                  label="full_name"
                  @input="addCastMember()"
                  taggable
                  :selectOnTab="true"
                  placeholder="+ actor/actress"
                  ></v-select>
              </td>
              <td v-if="edit" style="width: 50px;">
                <!-- <button @click.prevent="deleteNewActor(index)" class="button is-danger is-pulled-right">add</button> -->
              </td>
          </tr>
      </table>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        characterEntry: null,
        personEntry: null
      }
    },
    computed: {
      edit(){
        return this.$store.state.edit
      },
      people(){
        return this.$store.state.people
      }
    },
    props:['projectsPlay','projectsPlayKey'],
    methods: {
      deleteCastMember(id, actorKey){
        this.$store.dispatch('deleteCastMember',
          {
            id: id,
            projectsPlayKey: this.projectsPlayKey,
            actorKey: actorKey
          })
      },
      addCharacter(play_id, projectsPlayKey){
        // create character if no id set and change characterEntry to new entry
        if (!this.characterEntry.id && this.characterEntry.name.length > 0) {
          var name = this.characterEntry.name
          var payload = {name: name, play_id: play_id}
          axios
              .post('/api/characters',payload)
              .then(r => (
                this.characterEntry = r.data,
                // add character to Vuex store
                this.$store.dispatch('addCharacter',
                {
                  projectsPlayKey: this.projectsPlayKey,
                  character: this.characterEntry
                })
              ))
        }
        // change focus to person input field
        // this.$refs.actorSelect[0].$refs.search.focus()
      },
      addCastMember(){
        // create person if no id set
            // add person to Vuex store
        // set person_id to newCharacter object
        // create new cast member on server
        // add new cast member to Vuex store
        // empty newCharacter object
      }
    }
  }
</script>
<style scoped></style>
