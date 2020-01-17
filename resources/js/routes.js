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

const originalPush = Router.prototype.push;
Router.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err)
};

Vue.use(Router);

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters.isLoggedIn) {
      next()
      return
    }
    next('/ProyectoGrupal-IW/public/login')
}

const ifAuthenticated = (to, from, next) => {  
    if (store.getters.isLoggedIn) {
      next()
      return
    }
    next('/ProyectoGrupal-IW/public/login')
}

  
const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/ProyectoGrupal-IW/public/reservas',
            name: 'reservas',
            component: Reserva,
            beforeEnter: ifNotAuthenticated
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
        }
        /*,
        {
            path: '/secure',
            name: 'secure',
            component: Secure,
            meta: { 
              requiresAuth: true
            }
        },
        */
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