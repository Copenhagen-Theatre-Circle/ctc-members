<template>
    <nav class="menu">
        <ul class="menu-list">
                <li v-for="panel in panels">
                    <router-link :to="panel.route" exact>
                        <span class="icon">
                            <i :class="panel.icon"></i>
                        </span>
                        {{panel.name}}
                    </router-link>
                </li>
            <hr>
            <li v-show="!edit">
                <a @click="toggleEditMode()">
                    <span class="icon">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                    Edit
                </a>
            </li>
            <li v-show="edit" v-cloak>
                <a @click="toggleEditMode()" class="is-active">
                    <span class="icon">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                    Edit
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
  export default {
    data () {
        return {
            panels: {
                basics: {
                    name: "Basics",
                    icon: "fas fa-align-justify",
                    route: "basics"
                    },
                cast: {
                    name: "Cast",
                    icon: "fas fa-theater-masks",
                    route: "cast"
                    },
                crew: {
                    name: "Crew",
                    icon: "fas fa-people-carry",
                    route: "crew"
                    },
                videos: {
                    name: "Videos",
                    icon: "fas fa-video",
                    route: "videos"
                    },
                pictures: {
                    name: "Pictures",
                    icon: "fas fa-images",
                    route: "pictures"
                    },
                documents: {
                    name: "Documents",
                    icon: "fas fa-file",
                    route: "documents"
                    },
                testimonies: {
                    name: "Testimonies",
                    icon: "fas fa-book",
                    route: "testimonies"
                    }
                }
        }
    },
    methods: {
        toggleEditMode (){
            this.$store.dispatch('toggleEditMode')
        }
    },
    computed: {
        edit(){
            return this.$store.state.edit
        }
    }
  }
</script>
<style scoped></style>
