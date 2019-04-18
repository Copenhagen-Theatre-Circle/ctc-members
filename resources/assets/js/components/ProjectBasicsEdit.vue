<template>
    <div>
        <div class="field">
          <label class="label">Year</label>
          <div class="control">
            <input class="input" type="text" placeholder="Text input" v-model="year" name="year" @blur="saveData()">
          </div>
        </div>

        <div class="field">
          <label class="label">Number of Performances</label>
          <div class="control">
            <input class="input" type="text" placeholder="Text input" v-model="number_of_performances" name="number_of_performances">
          </div>
        </div>

        <div class="field">
          <label class="label">Date Start (YYYY-MM-DD) {{date_input}}</label>
          <div class="control">
            <input class="input" type="text" placeholder="Text input" v-model="date_start" name="date_start">
          </div>
        </div>
        <b-field label="Date Start">
            <b-datepicker
                v-model="date_input"
                placeholder="Click to select..."
                icon="calendar-today">
            </b-datepicker>
        </b-field>

        <div class="field">
          <label class="label">Date End (YYYY-MM-DD)</label>
          <div class="control">
            <input class="input" type="text" placeholder="Text input" v-model="date_end" name="date_end">
          </div>
        </div>

        <div class="field">
          <label class="label">Season</label>
          <div class="control">
            <div class="select">
              <select name="season_id">
                <option disabled selected></option>
                <option v-for="season in seasons" :value="season.id">
                  {{season.year_start}} / {{season.year_start+1}}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Venue</label>
          <div class="control">
                <div class="select">
                    <select name="venue_id">
                        <option disabled selected></option>
                        <option v-for="venue in venues" :value="venue.id">{{venue.name}}</option>
                    </select>
                </div>
          </div>
        </div>

<!--         @foreach (project.projects_plays as $projects_play)
            <div class="field">
              <label class="label">Synopsis</label>
              <div class="control">
                <textarea class="textarea" placeholder="Textarea" rows=10 name="projects_plays[{{$projects_play->id}}][synopsis_programme]">{{$projects_play->synopsis_programme}}</textarea>
              </div>
            </div>

            <div class="field">
              <label class="label">Director's Statement</label>
              <div class="control">
                <textarea class="textarea" placeholder="Textarea" rows=10 name="projects_plays[{{$projects_play->id}}][directors_statement]">{{$projects_play->directors_statement}}</textarea>
              </div>
            </div>
        @endforeach -->

    <!--     <div class="field">
            <label class="label">Publication Settings</label>
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" @if(project.publish_online) checked @endif name="publish_online" value=1>
              publish online
            </label>
          </div>
        </div> -->

        <!-- <div class="field">
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" @if(project.publish_book) checked @endif name="publish_book" value=1>
              publish in book
            </label>
          </div>
        </div> -->

        <!-- <div class="field">
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" @if(project.publish_members) checked @endif name="publish_members" value=1>
              publish to CTC Members
            </label>
          </div>
        </div> -->
        <hr>
        <div class="field is-grouped">
          <div class="control">
            <button class="button is-link">Submit</button>
          </div>
        </div>
    </div>
</template>
<script>
  import { mapFields } from 'vuex-map-fields';
  export default {
    data() {
      return {
        message: 'hello',
        date_input: null
      }
    },
    methods: {
      saveData(){
        alert ('this is being saved with year ' + this.$store.state.project.year)
      }
    },
    computed: {
      project() {
        return this.$store.state.project
      },
      seasons() {
        return this.$store.state.seasons
      },
      venues() {
        return this.$store.state.venues
      },
      ...mapFields([
        'project.year',
        'project.number_of_performances',
        'project.date_start',
        'project.date_end'
      ]),
    }
  }
</script>
<style scoped></style>
