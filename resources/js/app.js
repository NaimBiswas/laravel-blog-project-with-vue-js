

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { routes } from './routes/routes';
const router = new VueRouter({


    routes,
    mode:'history',
});



// Vue.component('home-component', require('./components/backend/dashboard/Dashboard.vue').default);
// Vue.component('category-component', require('./components/backend/category/category').default);

const app = new Vue({
    el: '#app',
    router,
});
