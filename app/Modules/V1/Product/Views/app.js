require('./bootstrap');

import vue from 'vue'
window.Vue = vue;

import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import Vue from 'vue';

window.Vue = require('vue');

Vue.component('Single', require('./components/Single.vue').default);
Vue.component('Variable', require('./components/Variable.vue').default);


Vue.prototype.$http = axios;
 
// const router = new VueRouter({
//     mode: 'history',
//     routes: routes
// });
 
const app = new Vue({
    el: '#app',
    // router: router,
    // render: h => h(App),
});

