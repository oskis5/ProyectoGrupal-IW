import Vue from 'vue';
import Router from 'vue-router';
import HelloWorld from './components/HelloWorld';
import HelloWorld2 from './components/HelloWorld2';

Vue.use(Router);

const router= new Router({
    mode: 'history',
    routes: [
        {
        path: '/',
        name: 'home',
        component: HelloWorld 
        },
        {
         path: '/prueba',
         name : 'prueba',
         component: HelloWorld2
        }
    ]
})

export default router;