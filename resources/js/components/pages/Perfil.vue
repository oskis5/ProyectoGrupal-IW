<template>
    <div class="w-75 mx-auto" style="padding: 6vh 10vw">
        
        <div v-for="item in reservas" :key="item" class="mb-2 text-left">
            <reserva :reserva="item"></reserva>
        </div>
    </div>
</template>

<script>
import ItemReserva from '../ItemReserva'

export default {
    data() {
        return {
            reservas: [],
        }
    },
    components: {
        reserva: ItemReserva
    },
    created: async function(){
        this.getReservas();
    },
    methods: {
        getReservas: async function(){
            var res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/reservas');
            var reservas = await res.json();
            this.reservas = reservas;
        },
    }
}
</script>