

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
//  {path: '/dashboard', component: dashboard },
];
const router = createRouter({

     history: createWebHashHistory(),
    routes,
});



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
