import axios from "axios";
import { get } from "jquery";

export default {
     state: {
        categoires: [],
         tags:[],
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
                tag.commit('fetchTags', response.data.tags);
            }).catch((error) => {

            });
        }
    },
    mutations: {
        fatchCategoires(state, data) {
            return state.categoires = data;
        },
        fetchTags(state,tag){
            return state.tags = tag;
        }
    },

    getters: {
        allCategory(state) {
            return state.categoires;
        },
        AllTags(state) {
            return state.tags;
        }
    },
};
