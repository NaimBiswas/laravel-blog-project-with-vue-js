

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// V form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import Swal from 'sweetalert2';
import swl from 'sweetalert2/dist/sweetalert2.js';

import 'sweetalert2/src/sweetalert2.scss';

window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});



window.Toast = Toast;



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
