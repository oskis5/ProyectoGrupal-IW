import Vue from 'vue';
import Router from 'vue-router';
import store from './store';

import Home from './components/pages/Home';
import Login from './components/pages/Login';
import Register from './components/pages/Register';
import ListaClientes from './components/pages/ListaClientes'
import ListaRecepcionistas from './components/pages/ListaRecepcionistas'
import ListaHabitacionesWM from './components/pages/ListaHabitacionesWM'
import Reserva from './components/pages/Reserva';
import ListHabitaciones from './components/pages/ListHabitaciones';
import Perfil from './components/pages/Perfil';
import ListReservas from './components/pages/ListReservas';

const originalPush = Router.prototype.push;
Router.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err)
};

Vue.use(Router);
  
const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/ProyectoGrupal-IW/public/reservas',
            name: 'reservas',
            component: Reserva,
            meta: { 
                requiresAuth: true
            }
        },
        {
            path: '/ProyectoGrupal-IW/public/perfil',
            name: 'perfil',
            component: Perfil,
            meta: { 
                requiresAuth: true
            }
        },
        {
            path: '/ProyectoGrupal-IW/public/',
            name: 'home',
            component: Home,
        },
        {
            path: '/ProyectoGrupal-IW/public/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/ProyectoGrupal-IW/public/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/ProyectoGrupal-IW/public/listaClientes',
            name: 'listaClientes',
            component: ListaClientes,
            meta: { 
                requiresAuth: true
            }
        },
        {
            path: '/ProyectoGrupal-IW/public/listaRecepcionistas',
            name: 'listaRecepcionistas',
            component: ListaRecepcionistas,
            meta: { 
                requiresAuth: true
            }
        },
        {
            path: '/ProyectoGrupal-IW/public/listaHabitacionesWM',
            name: 'listaHabitacionesWM',
            component: ListaHabitacionesWM,
            meta: { 
                requiresAuth: true
            }
        },
        {
            path: '/ProyectoGrupal-IW/public/habitaciones',
            name: 'ListHabitaciones',
            component: ListHabitaciones,
        },
        {
            path: '/ProyectoGrupal-IW/public/listReservas-wm',
            name: 'ListReservas',
            component: ListReservas,
            meta: { 
                requiresAuth: true
            }
        }
    ]
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/ProyectoGrupal-IW/public/login') 
    } else {
        next() 
    }
})

export default router;