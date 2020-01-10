import axios from "axios";
const API_URL= "http://localhost/ProyectoGrupal-IW/public/api/";


export default {
    state: {
        status : '',
        datosReserva: [],
        precioReserva: 0,
        precioReservaPension: 0,
        temporada : {fecha_incio: "" , fecha_fin : "" , precioTemporada: 0}
    },
    mutations:
    {
        incrementarPrecio(state,valor){
            state.precioReserva = valor;
        },
        incrementarPrecioPension(state,valor){
            state.precioReservaPension = valor;
        },
        incrementarPrecioTemporada(state,valor){
            console.log("pone valor")
            state.temporada.precioTemporada = valor;
        },
        ponerFechas(state,fechas){
            console.log("pone fechas")
            state.temporada.fecha_incio = fechas.f_incio;
            state.temporada.fecha_fin = fechas.f_fin;
        }
    },
    actions:
    {
        buscarHabitacion(context,idTipoHabitacion){
           return new Promise((resolve, reject) => {
            axios.get(API_URL + "tipoestancias/" + idTipoHabitacion)
            .then(response => {
                    if(response.status == 200){
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
                            context.commit('incrementarPrecioPension', response.data.precio)
                            resolve(response.data)
                        }
                })
                .catch(exception =>{
                        console.log("error " + exception)
                        reject(exception)
                })
            })
        },
        buscarTemporadas(context,fechaInicio){
            return new Promise((resolve,reject)=>{
                axios.get(API_URL + "temporadas")
                .then(response => {
                        if(response.status == 200){
                            for(let i=0; i< response.data.length; i++){
                                var temporada = {f_inicio : new Date(response.data[i].fecha_inicio) , f_fin : new Date(response.data[i].fecha_fin)}
                                if(fechaInicio.mes >= temporada.f_inicio.getMonth() && fechaInicio.mes <= temporada.f_fin.getMonth() 
                                    && fechaInicio.dia >= temporada.f_inicio.getDay() && fechaInicio.dia <= temporada.f_fin.getDay()){
                                    context.commit('ponerFechas', temporada)
                                    context.commit('incrementarPrecioTemporada',response.data[i].precio_unitario)
                                    resolve(response.data)
                                    break;
                                }

                            }
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