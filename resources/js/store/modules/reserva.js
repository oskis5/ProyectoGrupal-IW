import axios from "axios";
const API_URL= "http://localhost/ProyectoGrupal-IW/public/api/";


export default {
    state: {
        status : '',
        datosReserva: [],
        precioReserva: 0,
        precioReservaPension: 0 
    },
    mutations:
    {
        incrementarPrecio(state,valor){
            console.log("entramos en incrementar valor")
            state.precioReserva = valor;
        },
        incrementarPrecioPension(state,valor){
            state.precioReservaPension = valor;
        }
    },
    actions:
    {
        buscarHabitacion(context,idTipoHabitacion){
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
        },
        buscarTipoPension(context,idTipoReserva){
            return new Promise((resolve,reject)=>{
                axios.get(API_URL + "tiporeservas/" + idTipoReserva)
                .then(response => {
                        if(response.status == 200){
                            console.log(response.data.precio)
                            context.commit('incrementarPrecioPension', response.data.precio)
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