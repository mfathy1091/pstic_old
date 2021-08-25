require('./bootstrap');

import Vue from 'vue'

// Vue.component('mainapp', require('./components/mainapp.vue').default);
Vue.component('test', require('./components/test.vue').default);


const app = new Vue({
    el: '#app'
})