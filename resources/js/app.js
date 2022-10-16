/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 
 import Vue from 'vue'
 import BootstrapVue from 'bootstrap-vue'
 Vue.use(BootstrapVue)
 
 import vSelect from 'vue-select'
 Vue.component('v-select', vSelect)
 
 window.events = new Vue();
 
 window.flash = function (message, level = 'success') {
     window.events.$emit('flash', { message, level });
 };


Vue.component('customers', require('./components/customers/Customers.vue').default);
Vue.component('new-customer', require('./components/customers/NewCustomer.vue').default);
Vue.component('edit-customer', require('./components/customers/EditCustomer.vue').default);
Vue.component('show-customer', require('./components/customers/ShowCustomer.vue').default);

Vue.component('flash', require('./components/flash/Flash.vue').default);

const app = new Vue({
    el: '#app',
});
