import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home';
import HelloWorld2 from './components/HelloWorld2';

Vue.use(Router);

const router= new Router({
    mode: 'history',
    routes: [
        {
        path: '/ProyectoGrupal-IW/public/',
        name: 'home',
        component: Home 
        },
        {
         path: '/ProyectoGrupal-IW/public/prueba',
         name : 'prueba',
         component: HelloWorld2
        }
    ]
})

export default router;