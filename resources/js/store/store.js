import axios from "axios";



export default {
     state: {
        categoires: [],
        tags: [],
        posts: [],
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
        getPosts(posts) {
            axios.get('/get-posts').then((response) => {
                posts.commit('fetchPosts', response.data.posts);
                console.log(response.data.posts);
            }).catch((error) => {
                toastr.warning(error);
            });
        },

    },
    mutations: {
        fatchCategoires(state, data) {
            return state.categoires = data;
        },
        fetchTags(state,tag){
            return state.tags = tag;
        },
        fetchPosts(state, posts) {
            return state.posts = posts;
        }
    },

    getters: {
        allCategory(state) {
            return state.categoires;
        },
        AllTags(state) {
            return state.tags;
        },
        AllPosts(state) {
            return state.posts;
        }
    },
};
