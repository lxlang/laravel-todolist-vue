
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('TodoList', require('./components/TodoList.vue').default);
Vue.component('TodoList', require('./components/TodoList.vue'))
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Import, register and configure http client
 */
import axios from 'axios';
axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.put['Content-Type'] = 'application/json';
Vue.prototype.$http = axios;

/**
 * Import Alerting lib.
 */
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);


import TodoList from './components/TodoList.vue';

new Vue({
    el: '#TodoList',
    components: {
        'todolist': TodoList
    }
});
