require('./bootstrap');

import Vue from 'vue'
// import router from './router'

import common from './common'
Vue.mixin(common)

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

// Vue.component('mainapp', require('./components/mainapp.vue').default);
//Vue.component('test', require('./components/test.vue').default);
Vue.component('autocomplete-component', require('./components/AutocompleteComponent.vue').default);
Vue.component('trip-form', require('./components/TripForm.vue').default);
Vue.component('multi_step-form', require('./components/MultiStepForm.vue').default);
Vue.component('follow-ups', require('./components/FollowUps.vue').default);
Vue.component('check-individual', require('./components/CheckIndividual.vue').default);
Vue.component('add-individual', require('./components/AddIndividual.vue').default);
Vue.component('login-form', require('./components/pages/Login.vue').default);



const app = new Vue({
    el: '#app',
    // router,
})