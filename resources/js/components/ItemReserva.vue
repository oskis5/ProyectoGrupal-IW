<template>
    <b-card bg-variant="light" :header="estancia.nombre" header-bg-variant="secondary" header-text-variant="white">
        Fechas: {{reserva.f_entrada}} - {{reserva.f_salida}} <br>
        Tipo de estancia: {{tipo.nombre}} <br>
        Temporada: {{temporada.nombre}} <br>
        Precio final: {{reserva.precio_total}}€
    </b-card>
</template>

<script>
export default {
    name: 'ItemReserva',
    props: ['reserva'],
    data() {
        return {
            estancia: {},
            tipo: {},
            temporada: {}
        }
    },
    created: async function(){
        this.getDatos()
        var f_entrada = this.estancia.f_entrada
        console.log(f_entrada)
    },
    methods: {
        getDatos: async function(){
            var estancia = await fetch('http://localhost/ProyectoGrupal-IW/public/api/estancias/'+this.reserva.estancia_id)
            this.estancia = await estancia.json()

            var tipo = await fetch('http://localhost/ProyectoGrupal-IW/public/api/tipoestancias/'+this.reserva.tipo_id)
            this.tipo = await tipo.json()

            var temporada = await fetch('http://localhost/ProyectoGrupal-IW/public/api/temporadas/'+this.reserva.temporada_id)
            this.temporada = await temporada.json()
        },
    }
}
</script>