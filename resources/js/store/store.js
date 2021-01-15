export default {
    state: {
      data:  'test test',
    },
    getters: {
        test(state) {
            return state.data;
      }
    },
};
