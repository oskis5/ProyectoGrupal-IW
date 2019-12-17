import {Servicio_API} from "../Services/Servicio_API"
servicio_API = new Servicio_API("http://localhost/ProyectoGrupal-IW/public/api/");
export default moduloEstancia = {
    state : {
        estancias: servicio_API.obtenerEstancias().then(function(datos){
            return datos
          })
    },
    mutations: {

    },
    actions : {

    }
}