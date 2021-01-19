import axios from "axios";
import { get } from "jquery";
import { postCss } from "laravel-mix";

export default {
     state: {
        categoires: [],
        tags: [],
         poss: [],
    },
    actions: {
        getCategories(data) {
            axios.get("/get-categoy")
                .then(function(response){
                    data.commit("fatchCategoires", response.data.categories);
                }).catch((error) => {

                });
        },
        getTags(tag) {
            axios.get('/index-tag').then((response) => {
                tag.commit('fetchTags', response.data.tags);
            }).catch((error) => {
                toastr.warning(error);
            });
        },
        getPosts() {
            axios.get('/get-posts').then((response) => {
                postCss.commit('fetchPosts', response.data.posts);
            }).catch((error) => {
                toastr.warning(error);
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
