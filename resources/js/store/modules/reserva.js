import axios from "axios";
const API_URL= "http://localhost:81/ProyectoGrupal-IW/public/api/";
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
        buscarHabitacion(context,tipoReserva,tipoHabitacion){
            axios({})
            context.commit('incrementarPrecio')
        }

    }
}