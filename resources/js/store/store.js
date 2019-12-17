import Vue from 'vue'
import Vuex from 'vuex'
//import estancia from "./Moduls/Estancia"
import {Servicio_API} from './Services/Servicio_API.js'
var servicio_API = new Servicio_API("http://localhost/ProyectoGrupal-IW/public/api/");

Vue.use(Vuex)
export default new Vuex.Store({
    /*
    modules:{
        estancias : estancia
    }
    */
   state : {
    estancias: servicio_API.obtenerEstancias().then(function(datos){
        return datos
      })
    }
})