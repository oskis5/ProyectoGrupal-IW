<template>
    <div class="container mt-5">
    </br>
        <div class="row justify-content-center align-items-start">
            <div class="container p-2 col-12 col-md-6">
                <p class="text-left">Mostrando: <b>{{reservas.length}} de {{reservas.length + reservasCont.length}} filas</b></p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Estancia</th>
                            <th scope="col">Fecha de entrada</th>
                            <th scope="col">Fecha de salida</th>
                            <th scope="col">Coste total</th>
                        </tr>  
                    </thead>
                    <tbody>
                        <tr v-for="r in reservas" v-bind:id="r.id" @click="showDetails">
                            <th scope="row" v-bind:id="r.id">{{r.id}}</th>
                            <td v-bind:id="r.id">{{r.cliente.name}}</td>
                            <td v-bind:id="r.id">{{r.estancia.nombre}}</td>
                            <td v-bind:id="r.id">{{new Date(r.f_entrada).toDateString()}}</td>
                            <td v-bind:id="r.id">{{new Date(r.f_salida).toDateString()}}</td>
                            <td v-bind:id="r.id">{{r.precio_total}}€</td>
                        </tr>
                    </tbody>
                </table>
                <button v-if="reservasCont.length > 0" type="button" class="btn btn-secondary" v-on:click="addRows">Mostrar más</button>
            </div>
            <div class="container p-0 col-12 col-md-3 mt-4 mt-md-0">
                <h2 class="text-left">Detalles</h2>
                <div v-if="show" class="container detail-container">
                    <div class="row align-items-start justify-content-left">
                        <p>Nombre: <b>{{detalle.cliente.name}}</b></p>
                        <p>Habitación: <b>{{detalle.estancia.nombre}}</b></p>
                        <p>Tipo: <b>{{detalle.estancia.tipo.nombre}}</b></p>
                    </div>
                    <div class="row align-items-start justify-content-left">
                        <p>Días: <b>{{detalle.dias}}</b></p>
                        <p>Precio total: <b>{{detalle.precio_total}}</b></p>
                    </div>
                    <div class="row align-items-start justify-content-left">
                        <p>Desde: <b>{{new Date(detalle.f_entrada).toDateString()}}</b></p>
                        <p>Hasta: <b>{{new Date(detalle.f_salida).toDateString()}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Habitacion from '../Habitacion.vue';
export default{
    name: 'ListReservas',
    data(){
        return{
            reservas: [],
            reservasCont: [],
            detalle : {},
            show: false
        }
    },
    created: async function(){
        var res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/reservas');
        var reservas = await res.json();

        res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/estancias');
        var estancias = await res.json();

        res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/users');
        var clientes = await res.json();


        reservas.forEach(function(reserva){
            clientes.forEach(function(cliente){
                if(reserva.cliente_id = cliente.id){
                    reserva.cliente = cliente;
                }
            });

            estancias.forEach(function(estancia){
                if(reserva.estancia_id = estancia.id){
                    reserva.estancia = estancia;
                }
            });
        });
        this.reservas = reservas.slice(0, 3);
        this.reservasCont = reservas.slice(3, reservas.length);
    },
    methods: {
        addRows: function(){
            this.reservas = this.reservas.concat(this.reservasCont);
            this.reservasCont = [];
        },
        showDetails: async function(event){
            this.show = false;
            var detalle = this.reservas[parseInt(event.target.id)];
            var res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/tipoestancias/' + detalle.tipo_id);
            var tipo = await res.json(); 

            res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/users/'+ detalle.cliente_id);
            var cliente = await res.json();
            detalle.cliente = cliente;

            detalle.estancia.tipo = tipo;
            
            console.log(detalle);
            var d_inicio = new Date(detalle.f_entrada).getTime();
            var d_salida = new Date(detalle.f_salida).getTime();
            detalle.dias = (d_salida - d_inicio) / (1000 * 60 * 60 * 24);
            this.detalle = detalle;
            this.show = true;
        }
    }
}
</script>

<style scoped>
    .table th, .table td{
        padding: 0.9rem;
        font-size: 0.9rem;
    }

    .detail-container p{
        margin-right: 1rem;
    }
</style>