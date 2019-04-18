import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { getField, updateField } from 'vuex-map-fields';

Vue.use(Vuex)

export default new Vuex.Store({
    state: { // = data
        project: null,
        edit: false
    },

    getters:{ // = computed properties
        getField,
    },

    actions: { // = methods
        loadProject ({ commit }, id) {
              axios
                .get('/api/projects/'+id)
                .then(r => r.data)
                .then(project => {
                commit('SET_PROJECT', project)
                })
            },
        loadPeople ({ commit }) {
              axios
                .get('/api/people/')
                .then(r => r.data)
                .then(people => {
                commit('SET_PEOPLE', people)
                })
            },
        loadSeasons ({ commit }) {
              axios
                .get('/api/seasons/')
                .then(r => r.data)
                .then(seasons => {
                commit('SET_SEASONS', seasons)
                })
            },
        loadVenues ({ commit }) {
              axios
                .get('/api/venues/')
                .then(r => r.data)
                .then(venues => {
                commit('SET_VENUES', venues)
                })
            },
        toggleEditMode ({commit}) {
            commit('TOGGLE_EDIT_MODE')
        },
        updateProject({commit},payload){
            axios
              .put('/api/projects/'+payload.id,payload)
        },
        deleteCastMember({commit},payload){
            commit('DELETE_CAST_MEMBER', payload)
        },
        addCharacter({commit},payload){
            commit('ADD_CHARACTER',payload)
        },
        updateYear({commit},payload){
            commit('UPDATE_YEAR',payload)
        }
    },

    mutations: {
        SET_PROJECT (state, project){
            state.project = project
        },
        SET_PEOPLE (state, people){
            state.people = people
        },
        SET_SEASONS (state, seasons){
            state.seasons = seasons
        },
        SET_VENUES (state, venues){
            state.venues = venues
        },
        TOGGLE_EDIT_MODE (state) {
            state.edit = !state.edit
        },
        DELETE_CAST_MEMBER (state, payload) {
            state.project.projects_plays[payload.projectsPlayKey].actors.splice(payload.actorKey,1)
        },
        ADD_CHARACTER (state, payload) {
            state.project.projects_plays[payload.projectsPlayKey].characters.push(payload.character)
        },
        UPDATE_YEAR (state, payload) {
            state.project.year = payload
        },
        updateField,
    },
})
