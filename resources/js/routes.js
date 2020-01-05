import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/pages/Home';
import Login from './components/pages/Login';
import Register from './components/pages/Register';

Vue.use(Router);

const ifNotAuthenticated = (to, from, next) => {
    /*
    if (!store.getters.isLoggedIn) {
      next()
      return
    }
    next('/')
    */
}

const ifAuthenticated = (to, from, next) => {
    /*    
    if (store.getters.isLoggedIn) {
      next()
      return
    }
    next('/login')
    */
}

  
const router= new Router({
    mode: 'history',
    routes: [
        {
            path: '/ProyectoGrupal-IW/public/',
            name: 'home',
            component: Home,
            beforeEnter: ifAuthenticated
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: ifNotAuthenticated
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            beforeEnter: ifNotAuthenticated
        }
    ]
})

export default router;