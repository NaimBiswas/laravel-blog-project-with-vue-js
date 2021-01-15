

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// V form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import SweetAlert from 'sweetalert2';
import swl from 'sweetalert2/dist/sweetalert2.js';

import 'sweetalert2/src/sweetalert2.scss';
Vue.use(SweetAlert);






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
