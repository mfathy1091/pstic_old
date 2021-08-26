require('./bootstrap');
const moment= require('moment') 
import Vue from 'vue'
// import router from './router'

// Vue.component('mainapp', require('./components/mainapp.vue').default);
//Vue.component('test', require('./components/test.vue').default);
Vue.component('autocomplete-component', require('./components/AutocompleteComponent.vue').default);
Vue.component('trip-form', require('./components/TripForm.vue').default);
Vue.component('multi_step-form', require('./components/MultiStepForm.vue').default);



const app = new Vue({
    el: '#app',
    // router,
})