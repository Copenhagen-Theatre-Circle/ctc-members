<template>
    <section class="section" style="padding: 10px;" v-if="project">
       <div class="columns">
         <div class="column is-2" style="padding-left: 20px;">
           <!-- @if($photographs['poster']??null)
               <a href="/files/{{$photographs['poster'][0]}}" target="_blank">
                 <img src="https://res.cloudinary.com/ctcircle/image/fetch/w_200/https://ctc-members.dk/files/{{$photographs['poster'][0]}}">
               </a>
             <br>
             <br>
           @endif -->
         </div>
         <div class="column" >
           <h1 class="title is-1" style="margin-bottom: 10px;" v-if="project">{{project.name}}</h1>
           <!-- @if ($all_authors)
             <h4 class="title is-5" style="margin-bottom: 10px;">by {{implode(', ', $all_authors)}}</h4>
           @endif -->
           <!-- <h4 class="title is-5" style="margin-bottom: 10px;">{{date('d M Y',strtotime($project->date_start))}} to {{date('d M Y', strtotime($project->date_end))}}</h4>
           <h4 class="title is-5" style="margin-bottom: 10px;">{{$project->venue->name ?? ''}}</h4> -->
         </div>
       </div>
       <div class="card">
           <div class="card-content" style="padding: 0.8rem !important;">
               <div class="columns">
                   <div class="column is-2-widescreen is-3-desktop is-3-tablet has-background-white-bis">
                       <project-sidebar></project-sidebar>
                   </div>
                   <div class="column" style="padding-left:2%;padding-right:2%;">
                       <router-view></router-view>
                   </div>
               </div>
           </div>
       </div>
    </section>
</template>
<script>
  export default {
    data() {
      return {
        loading: false
      }
    },
    methods: {

    },
    computed: {
      project() {
        return this.$store.state.project
      }
    },
    created(){
        this.$store.dispatch('loadProject',this.$route.params.id)
        this.$store.dispatch('loadPeople')
        this.$store.dispatch('loadSeasons')
        this.$store.dispatch('loadVenues')
    }
  }
</script>
<style scoped></style>
