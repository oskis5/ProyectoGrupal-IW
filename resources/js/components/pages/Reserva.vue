<template>
    <!--
    <h4>Tipos de habitación</h4>
  <b-card-group deck>
      <b-card img-src="https://media-cdn.tripadvisor.com/media/photo-s/0e/a2/c1/9a/detalle-de-la-habitacion.jpg" img-alt="Card image" img-top>
        <b-card-text>
          Individual
        </b-card-text>
      </b-card>

      <b-card img-src="https://www.hotelprismabarcelona.com/wp-content/uploads/2018/04/Habitacio%CC%81n-Doble-cama-matrimonio-2_192.jpg" img-alt="Card image" img-top>
        <b-card-text>
          Doble
        </b-card-text>
      </b-card>
      <b-card img-src="https://s7d2.scene7.com/is/image/ritzcarlton/50554432-Junior%20Suite%20Ocean%20View%20bedroom%20corner?$XlargeViewport100pct$" img-alt="Card image" img-top>
        <b-card-text>
          Suite
        </b-card-text>
      </b-card>
    </b-card-group>
    -->
    <b-container fluid style="text-align: left">
     <b-form-group id="tipo-estancia" label="Tipo estancia" label-for="tipo-estancia" >
        <!-- v-bind="calcularTotal('tipo-estancia')" -->
        <b-form-select
          id="tipo-estancia"
          v-model="form.tipoEstancia"
          :options="tipoEstancias"
          required
        ></b-form-select>
      </b-form-group>
      <b-form-group id="tipo-reserva" label="Tipo de pensión" label-for="tipo-reserva">
        <b-form-select
          id="tipo-reserva"
          v-model="form.tipoReserva"
          :options="tipoReservas"
          required
        ></b-form-select>
        <!--  v-bind="calcularTotal('tipo-reserva')" -->
      </b-form-group>
      <b-form-group id="f-inicio" label="Fecha inicio:" label-for="f-inicio">
        <b-form-input
          id="f-inicio"
          v-model="form.f_inicio"
          required
          type = date
          placeholder="Seleccione fecha inicio"
        ></b-form-input>
      </b-form-group>
      <b-form-group id="f-final" label="Fecha final:" label-for="f-final">
        <b-form-input
          id="f-final"
          v-model="form.f_fin"
          required
          type = date
          placeholder="Seleccione fecha fin"
        ></b-form-input>
      </b-form-group>
        <!-- <b-form-input v-model="form.precio" type="number" debounce="500" >
        </b-form-input> -->
        <H5>Valor Total {{ precio }}</H5>
        <b-button type="Aceptar" @click="calcularTotal('tipo-estancia')" variant="primary">precio</b-button>
    </b-container>

</template>
<script>
export default {
    name : 'Reserva',
    data(){
        return {
            form: 
            {
                f_inicio: '',
                f_fin: '',
                //precio: 0,
                tipoEstancia: null,
                tipoReserva : null
            },
                tipoEstancias:[{text: 'Selecciona tipo de estancia', value: null}, { text : 'Habitación simple' , value : 1}
                 , {text : 'Habitación doble', value :  2 },{text: 'Suite', value: 3},
                 {text : 'Sala reuniones' , value: 4}],
                tipoReservas:[{text: 'Selecciona tipo de pensión', value: null}, 'Solo estancia' , 'Desayuno incluido', 'Media pensión',
                'Pensión completa', 'Catering'],
                precio : 0,
        }
    },
    computed : {
        precio : function(){
                    return this.$store.state.reserva.precio
                }
    },
    methods:{
        calcularTotal : function(event){
            console.log("ENTRAMOS EN CLICK")
            console.log(this.form.tipoEstancia)
                    console.log("distpach")
                    console.log("tipo estancia en form")
                    this.$store.dispatch("buscarHabitacion",0,this.form.tipoEstancia)
                    .then((datos) =>{
                        console.log(datos)
                        this.precio = datos
                    })
               /*
               if(this.form.tipoEstancia != null){
                   if(this.form.tipoEstancia == 'Habitación simple'){
                        this.precio = 50
                   }
                   if(this.form.tipoReserva == "Solo estancia"){
                       this.precio += 100
                   }
               }else if(this.form.tipoEstancia != null){

               }
               */
        }
    }
}
</script>
