import axios from "axios";
const API_URL= "http://localhost/ProyectoGrupal-IW/public/api/";


export default {
    state: {
        status : '',
        precioReserva: 0,
        diasReserva: 1,
        precioReservaPension: 0,
        temporada : {fecha_inicio: "" , fecha_fin : "" , precioTemporada: 0 , temporadaId: 0},
        habitacionReserva : null,
        userId: null
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
        },
        ponerDias(state,dias){
            state.diasReserva = dias;
        },
        establecerHabitacion(state,idHabitacion){
            state.habitacionReserva = idHabitacion
        },
        establecerUser(state,idUser){
            state.userId = idUser
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
            var cond = state.habitacionReserva 
            
            return new Promise((resolve,reject)=>{
                axios({
                    method: 'POST',
                    url: API_URL + "reservas",
                    data : {
                        estancia_id: ((state.habitacionReserva != null)? state.habitacionReserva : datosReserva.idEstancia),
                        cliente_id : ((state.userId != null )? state.userId : datosReserva.userId),
                        tipo_id : datosReserva.tipoEstancia,
                        temporada_id: state.temporada.temporadaId,
                        f_entrada: datosReserva.f_inicio,
                        f_salida: datosReserva.f_fin,
                        precio_total: (state.precioReserva 
                            + state.precioReservaPension 
                            + state.temporada.precioTemporada) 
                            * state.diasReserva
                    }
                })
                .then(resp =>{
                    //console.log(resp)
                })
            })
        },
        anyadirDiasPrecio(context,dias){
            context.commit('ponerDias', dias)
        },
        devolverHabitacionDisponible(context,tipoEstancia){
            axios.get(API_URL + "estancias")
            .then(response =>{
                for(let i=0; i< response.data.length; i++){
                    if(tipoEstancia == response.data[i].tipo_id){
                        context.commit('establecerHabitacion',response.data[i].tipo_id)
                        break;
                    }

                }
            })
        },
        buscarUserPorMail(context,emailUser){
            return new Promise((resolve,reject) =>{
                axios.get(API_URL + "emails/" + emailUser)
                .then(response =>{
                    context.commit('establecerUser', response.data.id)
                    resolve(response.data)
                })
            .catch(exception =>{
                console.log("error " + exception)
                reject(exception)
            })
        })    
        }
    }
}