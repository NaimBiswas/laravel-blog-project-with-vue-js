

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { routes } from './routes/routes';
const router = new VueRouter({


    routes,
    mode:'history',
});



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
