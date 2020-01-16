<template>
    <div class="container mx-auto my-4">
        <div class="row">
            <b-card no-body class="col p-0">
                <b-card-header header-tag="nav" header-bg-variant="dark" header-text-variant="white">
                    <b>Mis datos</b>
                </b-card-header>

                <div class="my-auto">
                    <div class="mb-5 text-center">
                        <img
                        style="width: 200px; border-radius: 100%; border: 1px solid black" 
                        :src="this.profile_img" 
                        alt=""
                        >
                    </div>
                    <div class="mb-3"><b>Nombre de usuario:</b><br> {{loggedUser.name}}</div>
                    <div class="mb-3"><b>Correo electrónico:</b><br> {{loggedUser.email}}</div>
                    <div class="mb-3"><b>Reservas realizadas:</b> {{reservas.length}}</div>
                </div>
            </b-card>
            <b-card no-body class="col p-0" style="max-height: 85vh">
                <b-card-header header-tag="nav" header-bg-variant="dark" header-text-variant="white">
                    <b>Histórico de reservas</b>
                </b-card-header>
                <div style="overflow-y: auto">
                    <div v-for="item in reservas" :key="item.id" class="text-left">
                        <reserva :reserva="item" class="m-2"></reserva>
                    </div>
                </div>
            </b-card>
        </div>
    </div>
</template>

<script>
import ItemReserva from '../ItemReserva'

export default {
    data() {
        return {
            reservas: [],
            profile_img: "https://pngimage.net/wp-content/uploads/2018/05/default-user-profile-image-png-6.png"
        }
    },
    components: {
        reserva: ItemReserva
    },
    computed: {
        loggedUser : function() { return this.$store.getters.loggedUser }
    },
    created: async function(){
        this.getReservas();
    },
    methods: {
        getReservas: async function(){
            var res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/users/'+ this.loggedUser.id +'/reservas');
            var reservas = await res.json();
            this.reservas = reservas;
        },
    }
}
</script>