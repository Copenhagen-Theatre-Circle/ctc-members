<template>
  <div>
    <div v-for="(projectsPlay, projectsPlayKey) in project.projects_plays">
      <project-cast-table
        :projectsPlay="projectsPlay"
        :projectsPlayKey="projectsPlayKey"
      />
      <br>
    </div>
      <div class="columns">
        <div class="column">
          <div v-if="edit" style="padding-top: 10px;">
            <label class="checkbox">
              <input type="checkbox" name="cast_is_complete" value=1 v-model="project.cast_is_complete" @change="updateProject()">
              all cast members have been entered
            </label>
          </div>
        </div>
        <div class="column">
          <!-- <button v-if="edit" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button> -->
        </div>
      </div>
      <div v-if="edit" style="height: 100px;"></div>
  </div>
</template>
<script>
  export default {
    computed: {
      project() {
        return this.$store.state.project
      },
      edit(){
        return this.$store.state.edit
      },
    },
    methods: {
      updateProject(){
        this.$store.dispatch('updateProject', this.$store.state.project)
      }
    }
  }
</script>
<style scoped>
</style>
