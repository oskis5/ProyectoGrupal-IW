<template>
  <div id="app">
    <h1> ESTAAAAAAAAAAA</h1>
    <b-navbar toggleable="lg" type="light" variant="light" class="py-0">
      <a class="navbar-brand my-0" href="#">
        <img alt="Vue logo" :src="'images/logo-h.png'" class="img-fluid" style="height: 70px">
      </a>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template v-slot:button-content>
            <em>Nombre de usuario</em>
          </template>
          <b-dropdown-item href="#">Perfil</b-dropdown-item>
          <b-dropdown-item href="#">Cerrar sesión</b-dropdown-item>
          <b-dropdown-item>
            <router-link :to="{name: 'prueba'}">Home</router-link>
          </b-dropdown-item> 
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>
   <Estancia></Estancia>
   <router-view></router-view>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import Estancia from './components/Estancia.vue'
export default {
  //<Estancia></Estancia>
  //    <router-view></router-view>
  name: 'app',
  components: {
    HelloWorld,
    Estancia
  }
  /*,
  computed: {
    items: function(){
      return this.$store.state.estancias
    } 
  }
  */
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
