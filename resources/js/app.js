

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import filter from './filter.js';
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
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})



window.swalWithBootstrapButtons = swalWithBootstrapButtons;



import { routes } from './routes/routes';
const router = new VueRouter({


    routes,
    mode:'history',
});

import Vuex from 'vuex';
Vue.use(Vuex);

import StoreData from './store/store';
const store = new Vuex.Store(
    StoreData,
);
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );


const app = new Vue({
    el: '#app',
    router,
    store: store,
});
