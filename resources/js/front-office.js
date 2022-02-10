// console.log('FRONT OFFICE');

//IMPORT DEPENDENCIES
import Vue from 'vue';
import App from './views/App';

//APP ROUTER.JS
import router from './routes';

//INIT VUE INSTANCE
const root = new Vue({
    el:'#root',
    router,
    render:h =>h(App),
})