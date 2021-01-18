import axios from "axios";
import { get } from "jquery";

export default {
     state: {
        categoires: [],
         tag:[],
    },
    actions: {
        getCategories(data) {
            axios.get("/get-categoy")
                .then(function(response){
                    data.commit("fatchCategoires", response.data.categories);
                }).catch((error) => {

                });
        },
        getTags() {
            axios.get('').then((response) => {

            }).catch((error) => {

            });
        }
    },
    mutations: {
        fatchCategoires(state, data) {
            return state.categoires = data;
        },
    },

    getters: {
        allCategory(state) {
            return state.categoires;
      }
    },
};
