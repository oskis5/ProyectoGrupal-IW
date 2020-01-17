<template>
    <b-container fluid style="text-align: left">
      <div v-if="user == true">
        <b-button v-b-toggle="'collapse-user'" class="m-1">Realizar reserva de un Usuario</b-button>
        <b-alert v-model="alertaBuscarUser" variant="danger" dismissible>
              ¡Debe buscar un usuario!
            </b-alert>
          <b-collapse id="collapse-user">
            <b-row style="padding-top: 20px">
                <b-col>
                  <b-form-group
                    class="mb-0"
                    label="Busqueda el usuario en la base de datos"
                    label-for="search"
                  >
                    <b-form-input
                      id="search"
                      v-model="emailUsuario"
                      placeholder="Introduzca el email del cliente"
                    ></b-form-input>
                </b-form-group>
                <b-button style="margin-top: 10px" @click="search">Buscar datos usuario</b-button>
                  <h3>Nombre usuario: {{nombreUsuario}}</h3>
                    
                </b-col>
                <b-col>
                    <b-form-group
                        class="mb-0"
                        label="Nombre"
                        label-for="nombre"
                      >
                        <b-form-input
                          id="nombre"
                          v-model="emailUsuario"
                          placeholder="Introduzca el nombre del cliente"
                        ></b-form-input>
                    </b-form-group>
                    <b-form-group
                        class="mb-0"
                        label="email"
                        label-for="email"
                      >
                        <b-form-input
                          id="email"
                          v-model="emailUsuario"
                          placeholder="Introduzca el email del cliente"
                        ></b-form-input>
                    </b-form-group>
                    <b-form-group
                        class="mb-0"
                        label="paswword"
                        label-for="password"
                      >
                        <b-form-input
                          id="password"
                          v-model="emailUsuario"
                          placeholder="Introduzca la password del cliente"
                        ></b-form-input>
                    </b-form-group>
                    <b-button style="margin-top: 10px">Crear</b-button>
                </b-col>
              </b-row>
            </b-collapse>
      </div>
      <b-row> 
        <b-col>
          <b-form-group id="tipo-estancia" label="Tipo estancia" label-for="tipo-estancia" >
            <b-form-select
              id="tipo-estancia"
              v-model="form.tipoEstancia"
              v-b-toggle.collapse-foto
              :options="tipoEstancias"
              @change="calcularTotal('tipo-estancia')"
              required
            ></b-form-select>
            <b-alert v-model="alertaEstanciaVisible" variant="danger" dismissible>
              ¡Seleccione una opción correcta!
            </b-alert>
          </b-form-group>
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
              @change="calcularDiasReservas()"
              placeholder="Seleccione fecha fin"
            ></b-form-input>
          </b-form-group>
          <h4 :value="precio" @input="calcularTotal">Valor total reserva {{ precio }}</h4>
          <b-button ref="btnSubmit" @click="onSubmit" type="submit" variant="outline-primary">Confirmar reserva</b-button> 
            <b-alert v-model="alertaSubtmitVisible" variant="danger" dismissible>
                ¡Debe seleccionar todos los campos!
            </b-alert>
        </b-col> 
        <b-col>
        <b-collapse id="collapse-foto-suite" class="mt-2" v-model="visibleSuite">
          <b-card img-src="https://s7d2.scene7.com/is/image/ritzcarlton/50554432-Junior%20Suite%20Ocean%20View%20bedroom%20corner?$XlargeViewport100pct$" img-alt="Card image" img-top>
            <p class="card-text">
              Suite!
            </p>
          </b-card>
        </b-collapse>
        <b-collapse id="collapse-foto-doble" class="mt-2" v-model="visibleDoble">
          <b-card img-src="https://www.hotelprismabarcelona.com/wp-content/uploads/2018/04/Habitacio%CC%81n-Doble-cama-matrimonio-2_192.jpg" img-alt="Card image" img-top>
            <p class="card-text">
              Habitación para dos personas
            </p>
          </b-card>
        </b-collapse>
        <b-collapse id="collapse-foto-individual" class="mt-2" v-model="visibleIndividual">
          <b-card img-src="https://media-cdn.tripadvisor.com/media/photo-s/0e/a2/c1/9a/detalle-de-la-habitacion.jpg" img-alt="Card image" img-top>
            <p class="card-text">
              Habitación individual
            </p>
          </b-card>
        </b-collapse>
        <b-collapse id="collapse-foto-sala-conferencias" class="mt-2" v-model="visibleConferencia">
          <b-card img-src="https://s3-eu-west-1.amazonaws.com/spaceson/uploads/room_image/image/2504/slider_7_Sal_n_Conferencias.jpg" img-alt="Card image" img-top>
            <p class="card-text">
              Sala de conferencias para congresos o reuniones!
            </p>
          </b-card>
        </b-collapse>
      </b-col> 
      </b-row> 
      <div>
        <b-modal size="xl" ref="modal-confirmar" hide-footer title="¿Confirmar datos?">
          <div class="d-block text-center">
            <h3>Confirme o decline</h3>
          </div>
          <b-button class="mt-3" variant="success" block @click="confirmReserva">Confimar</b-button>
          <b-button class="mt-2" variant="danger" block @click="hideModal">No confirmar</b-button>
        </b-modal>
  
      </div>
    </b-container>


</template>
<script>
export default {
  name : 'Reserva',
  data(){
    return {
      form: {
        f_inicio: '',
        f_fin: '',
        tipoEstancia: null,
        tipoReserva : null,
        idEstancia : null,
        userId: null
      },
      registrar : {
        email: '',
        nombre: '',
        password: '',
      },
      tipoEstancias: [
        { text: 'Selecciona tipo de estancia', value: null }, 
        { text : 'Habitación simple' , value : 1 },
        { text : 'Habitación doble', value : 2 },
        { text: 'Suite', value: 3 },
        { text : 'Sala reuniones' , value: 4 }
      ],
      tipoReservas:[
        { text: 'Selecciona tipo de pensión', value: null },
        { text : 'Solo estancia', value: 1 }, 
        { text:'Desayuno incluido', value: 2 }, 
        { text:'Media pensión', value: 3 }, 
        { text:'Pensión completa', value: 4 }
      ],
      alertaEstanciaVisible : false,
      alertaReservaVisible :  false,
      alertaBuscarUser :  false,
      nombreCollapse : '',
      alertaSubtmitVisible : false,
      visibleSuite : false,
      visibleDoble : false,
      visibleIndividual : false,
      visibleConferencia : false,
      rolUser : '',
      emailUsuario: '',
      nombreUsuario: ''
    }
  },
  created : function(){
    if(this.$route.params){
      if(this.$route.params.fecha != null){
        this.form.f_inicio = this.$route.params.fecha;
      }
      if(this.$route.params.tipoHab != null){
        this.form.tipoEstancia = parseInt(this.$route.params.tipoHab);
        this.visibleCollapseDesdeRouter();
      }
      if(this.$route.params.tipoPension != null){
        this.form.tipoReserva = parseInt(this.$route.params.tipoPension);
      }
      if(this.$route.params.habId != null){
         this.form.idEstancia = this.$route.params.habId
         console.log("Id habitacion " + this.$route.params.habId)
      }
       //console.log("Id habitacion " + this.$route.params.habId)

    }
  },
  computed : {
    precio : function() {
      return (this.$store.state.reserva.precioReserva 
        + this.$store.state.reserva.precioReservaPension
        + this.$store.state.reserva.temporada.precioTemporada)
        * this.$store.state.reserva.diasReserva
    },
    user : function(){
      console.log(this.$store.getters.userRole)
      return (this.$store.getters.userRole == 'Recepcion' || 
      this.$store.getters.userRole == 'Webmaster')
    }
  },
  methods:{
    calcularTotal : function(event) {
      if (event == "tipo-estancia") {
        if (this.form.tipoEstancia == null) {
          this.alertaEstanciaVisible = true
        } else {
          this.$root.$emit('bv::toggle::collapse', this.nombreCollapse)
          this.switchNombreCollapse();
          this.$root.$emit('bv::toggle::collapse', this.nombreCollapse)
          this.alertaEstanciaVisible = false
          
          this.$store.dispatch("buscarHabitacion",this.form.tipoEstancia)
          .then(resp =>{})
          this.$store.dispatch("devolverHabitacionDisponible",this.form.tipoEstancia)
          .then()
    
        }
      } else if (event == "tipo-reserva") {
        if(this.form.tipoReserva == null){
            this.alertaReservaVisible = true;
        } else {
          this.alertaReservaVisible = false;
          this.$store.dispatch("buscarTipoPension",this.form.tipoReserva)
          .then(resp =>{})
        }
      }      
    },
    switchNombreCollapse: function(){
      switch(this.form.tipoEstancia){
        case 1:
        this.nombreCollapse = 'collapse-foto-individual'
        this.visibleDoble = false
        this.visibleSuite = false
        this.visibleConferencia = false
          break;
        case 2:
        this.nombreCollapse = 'collapse-foto-doble'
        this.visibleSuite = false
        this.visibleConferencia = false
        this.visibleIndividual =  false
          break;
        case 3:
        this.nombreCollapse = 'collapse-foto-suite'
        this.visibleConferencia = false
        this.visibleConferencia = false
        this.visibleIndividual =  false
          break;
        case 4:
        this.nombreCollapse = 'collapse-foto-sala-conferencias'
        this.visibleSuite = false
        this.visibleDoble = false
        this.visibleIndividual =  false
          break;
      }
    },
    calcularTemporada : function(){ //Solo vamos a fijarnos en la fecha de inicio para la temporada
        var fechaForm =  new Date(this.form.f_inicio)
        this.$store.dispatch("buscarTemporadas",fechaForm)
                .then(resp =>{
                })
    },
    onSubmit(evt){
      if(this.form.f_inicio=='' || this.form.f_fin =='' || this.form.tipoEstancia == null || this.form.tipoReserva == null){
          this.alertaSubtmitVisible = true
      }else{
          this.alertaSubtmitVisible = false
          this.$refs['modal-confirmar'].show()
    }
  },
    confirmReserva(){
      //Solo si es cliente puede realizar reservas para el
      if(this.$store.getters.userRole == 'Cliente'){
        this.form.userId = this.$store.getters.loggedUser.id
      }else{
          //this.alertaBuscarUser = true
      }
      this.$store.dispatch("realizarReserva",this.form)
      .then(resp =>{})
      this.hideModal()
    },
    hideModal(){
      this.$refs['modal-confirmar'].hide()
    },
    visibleCollapseDesdeRouter(){
      switch(this.form.tipoEstancia){
          case 1:
            this.visibleIndividual =  true
            break;
          case 2:
            this.visibleDoble = true
            break;
          case 3:
            this.visibleSuite = true
            break;
          case 4:
            this.visibleConferencia = true
            break;
        }
    },
    calcularDiasReservas(){
      if(this.form.f_inicio != '' && this.form.f_fin != ''){
        var oneDay = 24 * 60 * 60 * 1000;
        var fechaInicioForm =  new Date(this.form.f_inicio)
        var fechaFinForm = new Date(this.form.f_fin)
        //anyadirDiasPrecio dispatch
        var totalDias = Math.round(Math.abs((fechaInicioForm - fechaFinForm) / oneDay));
        if(totalDias != 0){
            this.$store.dispatch("anyadirDiasPrecio",totalDias)
            .then(resp =>{})   
        }
      }
    },
    search(){
      this.$store.dispatch("buscarUserPorMail",this.emailUsuario)
            .then(resp =>{
              this.nombreUsuario = resp.name
            }) 
    }
  }
}
</script>
