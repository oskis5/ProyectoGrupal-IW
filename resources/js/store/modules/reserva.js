import axios from "axios";
const API_URL= "http://localhost/ProyectoGrupal-IW/public/api/";


export default {
    state: {
        status : '',
        datosReserva: [],
        precioReserva: 0
    },
    mutations:
    {
        incrementarPrecio(state,valor){
            console.log("entramos en incrementar valor")
            state.precioReserva += valor;
        }

    },
    actions:
    {
        buscarHabitacion(context,idTipoHabitacion){
            /*
            return new Promise((resolve, reject) => {
                console.log(idTipoReserva + "   " + idTipoHabitacion)
                resolve(10)
            })
            */
           /*
           var url = API_URL + "tipoestancias/" + idTipoHabitacion
           console.log(url)
           return axios.get(API_URL + "tipoestancias/" + idTipoHabitacion)
           .then((response) => {
                if(response.status == 200){
                    console.log(response.data.precio_tipo)
                    context.commit('incrementarPrecio', datos.precio_tipo)
                }
           })
           */
           /*axios({URL: API_URL + "tipoestancias/" + idTipoHabitacion ,  method: 'get'})
            .then((datos) =>{
                console.log(datos)
                context.commit('incrementarPrecio', datos.precio_tipo)
            })
            */

           return new Promise((resolve, reject) => {
            axios.get(API_URL + "tipoestancias/" + idTipoHabitacion)
            .then(response => {
                    if(response.status == 200){
                        console.log(response.data.precio_tipo)
                        context.commit('incrementarPrecio', response.data.precio_tipo)
                        resolve(response.data)
                    }
            })
            .catch(exception =>{
                    console.log("error " + exception)
                    reject(exception)
            })
           })
        }
    }
}