import Vue from 'vue';
import App from './App.vue'
import Vuex from 'vuex'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import router from './routes.js';

Vue.use(BootstrapVue);
Vue.use(Vuex);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});

export default app;
