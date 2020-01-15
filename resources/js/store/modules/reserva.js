import axios from "axios";
const API_URL= "http://localhost/ProyectoGrupal-IW/public/api/";


export default {
    state: {
        status : '',
        precioReserva: 0,
        precioReservaPension: 0,
        temporada : {fecha_inicio: "" , fecha_fin : "" , precioTemporada: 0 , temporadaId: 0}
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
            state.temporada.precioTemporada = valor;
        },
        ponerIdTemporada(state,id){
            state.temporada.temporadaId = id;
        },
        ponerFechas(state,fechas){
            state.temporada.fecha_inicio = fechas.f_incio;
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
                                if(fechaInicio >= temporada.f_inicio && fechaInicio <= temporada.f_fin){
                                    context.commit('ponerFechas', temporada)
                                    context.commit('incrementarPrecioTemporada',response.data[i].precio_unitario)
                                    context.commit('ponerIdTemporada', response.data[i].id)
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
        },
        realizarReserva({state,context},datosReserva){
            console.log(datosReserva.f_inicio);
            console.log(state.temporada.temporadaId)
            console.log(state.temporada.precioReserva + state.temporada.precioReservaPension + state.tem)
            return new Promise((resolve,reject)=>{
                axios({
                    method: 'POST',
                    url: API_URL + "reservas",
                    data : {
                        estancia_id: datosReserva.tipoEstancia,
                        cliente_id : 1,
                        tipo_id : datosReserva.tipoEstancia,
                        temporada_id: state.temporada.temporadaId,
                        f_entrada: datosReserva.f_inicio,
                        f_salida: datosReserva.f_fin,
                        precio_total: state.precioReserva + state.precioReservaPension + state.temporada.precioTemporada 
                    }
                })
                .then(resp =>{
                    console.log(resp)
                })
            })
        }
    }
}