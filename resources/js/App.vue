<script src="http://localhost:8098"></script>

<template>
  <div id="app">
    <b-navbar fixed="top" toggleable="lg" type="light" variant="light" class="py-0">
      <router-link class="navbar-brand my-0" :to="{name: 'home'}">
        <img alt="Vue logo" :src="'images/logo-h.png'" class="img-fluid" style="height: 70px">
      </router-link>
      
      <b-navbar-nav class="ml-auto">
      <b-nav-item v-if="isLoggedIn && userRole == 'Webmaster'" :to="{name: 'ListReservas'}">Informes reservas</b-nav-item>
        <b-nav-item v-if="isLoggedIn && userRole == 'Webmaster'" :to="{name: 'listaClientes'}">Lista Clientes</b-nav-item>
        <b-nav-item v-if="isLoggedIn && userRole == 'Webmaster'" :to="{name: 'listaRecepcionistas'}">Lista Recepcionistas </b-nav-item>
        <b-nav-item v-if="isLoggedIn && userRole == 'Webmaster'" :to="{name: 'listaHabitacionesWM'}">Lista Habitaciones</b-nav-item>
        <b-nav-item-dropdown v-if="isLoggedIn" right>
          <template v-slot:button-content>
            <span style="padding-right: 10px; font-size: 20px">{{loggedUser.name}}</span>
          </template>
          <b-dropdown-item :to="{name: 'perfil'}">Mi perfil</b-dropdown-item>
          <b-dropdown-item v-on:click="logout()">Cerrar sesión</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item v-if="!isLoggedIn" :to="{name: 'login'}">Iniciar sesión</b-nav-item>
        <b-nav-item v-if="!isLoggedIn" :to="{name: 'register'}">Registrarse</b-nav-item>
      </b-navbar-nav>
    </b-navbar>

    <router-view style="margin-top: 100px"></router-view>

    
  </div>
</template>

<script>
export default {
  name: 'app',
  computed : {
    isLoggedIn : function(){ return this.$store.getters.isLoggedIn },
    loggedUser : function(){ return this.$store.getters.loggedUser },
    userRole : function(){ return this.$store.getters.userRole },
  },
  methods: {
      logout: function () { 
          this.$store.dispatch('logout')
          .then(() => this.$router.push('/ProyectoGrupal-IW/public/login'))
      }
  },
  created: function () {
    this.$http.interceptors.response.use(undefined, function (err) {
      return new Promise(function (resolve, reject) {
        if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
          this.$store.dispatch('logout')
        }
        throw err;
      });
    });
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
