import axios from "axios";

export default {
     state: {
      categoires: [],
    },
    actions: {
        getCategories(data) {
            axios.get("/get-categoy")
                .then(function(response){
                    data.commit("fatchCategoires", response.data.categories);
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
