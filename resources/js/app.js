

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// V form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// import Swal from 'sweetalert2';
import Swal from 'sweetalert2/dist/sweetalert2.js';
import toastr from 'toastr';

window.Swal = Swal;
window.toastr = toastr;
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




const app = new Vue({
    el: '#app',
    router,
});
