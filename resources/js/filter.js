import Vue from 'vue';
Vue.filter('subStrign', (content, length) => {
    return content.substring(0,length);
});
