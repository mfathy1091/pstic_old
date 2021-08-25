require('./bootstrap');

import Vue from 'vue'
// import router from './router'

// Vue.component('mainapp', require('./components/mainapp.vue').default);
//Vue.component('test', require('./components/test.vue').default);
Vue.component('autocomplete-component', require('./components/AutocompleteComponent.vue').default);



const app = new Vue({
    el: '#app',
    // router,
})