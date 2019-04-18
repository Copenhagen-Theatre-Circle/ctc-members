import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './project_spa_routes';
import store from './project_spa_store';
import vSelect from 'vue-select'
import Datepicker from 'buefy/dist/components/datepicker'
import Field from 'buefy/dist/components/field'


Vue.use(VueRouter)
Vue.use(Datepicker)
Vue.use(Field)

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('v-select', vSelect);

window.eventHub = new Vue();
window.axios = require('axios');

const app = new Vue({
    el: '#app',
    store: store,
    router: new VueRouter(routes)
});


