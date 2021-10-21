/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.component('app', require('./App.vue').default);
Vue.component('displayUsers', require('./components/usersPage/DisplayUsers.vue').default);
Vue.component('menuOptions', require('./components/shared/MenuOptions.vue').default);
Vue.component('calendar', require('./components/shared/Calendar.vue').default);
Vue.component('adminMenu', require('./components/AdminMenu.vue').default);
Vue.component('rolePage', require('./components/rolesPage/RolesPage.vue').default);
Vue.component('postPage', require('./components/postPage/PostPage.vue').default);
Vue.component('createUser', require('./components/usersPage/CreateUser.vue').default);
Vue.component('admin', require('./components/Admin.vue').default);
Vue.component('notifications', require('./components/shared/Notifications.vue').default);
Vue.component('messagesNotifications', require('./components/shared/MessageNotifications.vue').default);
Vue.component('chat', require('./components/shared/Chat.vue').default);
import {routesVue} from './routesVue';
import {route} from './routes';
import App from './App.vue';
import MenuOptions from './components/shared/MenuOptions';
import Notifications from './components/shared/Notifications';
import MessageNotifications from './components/shared/MessageNotifications';
import Vue from 'vue';
import axios from 'vue-axios';
import VueAxios from 'axios';
import VueRouter from 'vue-router';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);


const router = new VueRouter({
    mode:'history',
    routes: routesVue
})
import Echo from 'laravel-echo';
 window.io = require('socket.io-client');
  if(io !==undefined){
    window.Echo = new Echo({
        broadcaster: 'socket.io',
        forceTLS: false,
        host :window.location.hostname + ':6001',
    });
    console.log('io connected');
    console.log(window.Echo);
 }
 tinyMCE.init({selector:'#mytextarea'})
const app = new Vue({
    el:'#appAdminPage',
    router: router
})
const menuOptions = new Vue({
    el:'#appMenuOptions',
    router: router,
    render: h => h(MenuOptions)
})
const notifications = new Vue({
    el : '#notifications',
    router:router,
    render : h => h(Notifications)
});

const messageNotifications = new Vue({
    el : '#messageNotifications',
    router:router,
    render : h => h(MessageNotifications)
});
