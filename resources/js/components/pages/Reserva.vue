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
        <b-form-select
          id="tipo-estancia"
          v-model="form.tipoEstancia"
          v-b-toggle.collapse-foto
          :options="tipoEstancias"
          @change="calcularTotal('tipo-estancia')"
          required
        ></b-form-select>
          <!-- v-b-toggle.collapse-foto -->
        <b-alert v-model="alertaEstanciaVisible" variant="danger" dismissible>
          ¡Seleccione una opción correcta!
        </b-alert>
      </b-form-group>
    <!-- <b-button v-b-toggle.collapse-1 variant="primary">Toggle Collapse</b-button> -->
    <!-- CARD CON FOTOS AL SELECCIONAR -->
    <b-collapse id="collapse-foto" class="mt-2">
      <b-card img-src="https://s7d2.scene7.com/is/image/ritzcarlton/50554432-Junior%20Suite%20Ocean%20View%20bedroom%20corner?$XlargeViewport100pct$" img-alt="Card image" img-top>
        <p class="card-text">Foto</p>
      </b-card>
    </b-collapse>
      <b-form-group id="tipo-reserva" label="Tipo de pensión" label-for="tipo-reserva">
        <b-form-select
          id="tipo-reserva"
          v-model="form.tipoReserva"
          :options="tipoReservas"
          @change="calcularTotal('tipo-reserva')"
          required
        ></b-form-select>
        <!--  v-bind="calcularTotal('tipo-reserva')" -->
        <b-alert v-model="alertaReservaVisible" variant="danger" dismissible>
          ¡Seleccione una opción correcta!
        </b-alert>
      </b-form-group>
      <b-form-group id="f-inicio" label="Fecha inicio:" label-for="f-inicio">
        <b-form-input
          id="f-inicio"
          v-model="form.f_inicio"
          required
          type = date
          @change="calcularTemporada()"
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
        <H5 :value="precio" @input="calcularTotal">Valor total reserva </H5>
        <h2>{{ precio }}</h2>
        <b-button variant="outline-primary">Confirmar reserva</b-button>
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
                tipoEstancia: null,
                tipoReserva : null,
            },
                tipoEstancias:[{text: 'Selecciona tipo de estancia', value: null}, { text : 'Habitación simple' , value : 1}
                 , {text : 'Habitación doble', value :  2 },{text: 'Suite', value: 3},
                 {text : 'Sala reuniones' , value: 4}],
                tipoReservas:[{text: 'Selecciona tipo de pensión', value: null},{text : 'Solo estancia', value: 1} , {text:'Desayuno incluido', value:2}, 
                {text:'Media pensión', value: 3}, {text:'Pensión completa', value: 4}],
                alertaEstanciaVisible : false,
                alertaReservaVisible :  false
                // 'Catering'],
        }
    },
    computed : {
        precio : function(){
          return this.$store.state.reserva.precioReserva + this.$store.state.reserva.precioReservaPension
                  + this.$store.state.reserva.temporada.precioTemporada
      }
    },
    methods:{
        calcularTotal : function(event){
            if(event == "tipo-estancia"){
              if(this.form.tipoEstancia == null){
                  this.alertaEstanciaVisible = true
              }else{
                this.alertaEstanciaVisible = false
                  this.$store.dispatch("buscarHabitacion",this.form.tipoEstancia)
                    .then(resp =>{
                    })
              }
            }else if(event == "tipo-reserva"){
              if(this.form.tipoReserva == null){
                  this.alertaReservaVisible = true;
              }else{
                this.alertaReservaVisible = false;
                this.$store.dispatch("buscarTipoPension",this.form.tipoReserva)
                  .then(resp =>{
                  })
              }
            }      
        },
        calcularTemporada : function(){ //Solo vamos a fijarnos en la fecha de inicio para la temporada
           var fechaForm =  new Date(this.form.f_inicio)
           var fecha = {mes : fechaForm.getMonth() ,dia :  fechaForm.getDay()}
           this.$store.dispatch("buscarTemporadas",fecha)
                    .then(resp =>{
                    })
        }
    }
}
</script>
