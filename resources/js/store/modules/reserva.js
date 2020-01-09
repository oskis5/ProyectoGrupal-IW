import axios from "axios";
const API_URL= "http://localhost/ProyectoGrupal-IW/public/api/";


export default {
    state:
    {
        status : '',
        datosReserva: [],
        precioReserva: 0
    },
    mutations:
    {
        incrementarPrecio(valor){
            state.precioReserva += valor;
        }

    },
    actions:
    {
        buscarHabitacion(context,idTipoReserva,idTipoHabitacion){
            return idTipoReserva
            console.log(idTipoReserva)
            console.log(idTipoHabitacion)
            console.log(context)
            /*return new Promise((resolve, reject) => {
                console.log(idTipoReserva + "   " + idTipoHabitacion)
                resolve(10)
            })*/
           /* axios({URL: API_URL + "tipoestancias/" + idTipoHabitacion ,  method: 'GET'})
            .then((datos) =>{
                console.log(datos)
                context.commit('incrementarPrecio', datos.precio_tipo)
            })
            */
        }
    }
}