<template>
    <div>
        <table class="table no-border">
            <tr>
                <td style="vertical-align: top">
                    Season:
                </td>
                <td>
                    {{project.season.year_start}}/{{project.season.year_start+1}}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top">
                    Performances:
                </td>
                <td>
                    {{project.number_of_performances}}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top">
                    Director<span v-if="project.directors.length > 1">s</span>:
                </td>
                <td>
                    <span v-for="(director, key) in project.directors">
                        {{director.person.full_name}}<span v-if="key !== project.directors.length - 1">, </span>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    Synopsis:
                </td>
                <td>
                    <div v-for="projects_play in project.projects_plays">
                            <h5 v-if="project.projects_plays.length > 1">
                                {{projects_play.play.title}}
                            </h5>
                        <p v-html="projects_play.synopsis_programme" />
                        <br/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Director's Statement:
                </td>
                <td>
                    <div v-for="projects_play in project.projects_plays" >
                        <h5 v-if="project.projects_plays.length > 1">
                            {{projects_play.play.title}}
                        </h5>
                        <p v-html="projects_play.directors_statement" />
                        <br/>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>
<script>
  export default {
    computed: {
      project() {
        return this.$store.state.project
      },
    }
  }
</script>
<style scoped>
    h5 {
        margin-bottom: 0.5rem;
        font-weight: bold;
        text-decoration: underline;
    }
</style>
