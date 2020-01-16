<template>
    <div class="container">
        <!-- Filtros -->
        <form @submit="filtraEstancias">
          <div class="container my-3">
            <div class="row align-content-between">
                <div class="form-group text-left col-12 col-sm-6">
                  <label for="date-picker">Fecha</label>
                  <input v-model="fecha" class="date-picker form-control mb-3" id="date-picker" type="date" name="bday">
                  <label for="type-sel">Tipo de estancia</label>
                  <select v-model="tipoEstancia" class="form-control" id="type-sel">
                    <option value="0">Todas</option>
                    <option value="1">Sencilla</option>
                    <option value="2">Doble</option>
                    <option value="3">Suite</option>
                    <option value="4">Sala de reuniones</option>
                  </select>
                </div>
                <!-- Precios -->
                <div class="form-group filter-container col-12 offset-sm-2 col-sm-4 px-4 px-xs-0 text-left">
                  <label for="sl-min">Precio min.</label>
                  <div class="row range-picker align-content-between">
                    <input v-model="precioMin" class="form-control col-8 p-0" id="sl-min" type="range" name="points" min="0" max="600" step="5" @input="rangeUpdate">
                    <input class="col-2 p-1" classtype="text" id="min-textInput" value="0" >
                  </div>

                  <label for="sl-max">Precio max.</label>
                  <div class="row range-picker text-left">
                    <input v-model="precioMax" class="form-control col-8 p-0" id="sl-max" type="range" name="points" min="50" max="600" step="5"  @input="rangeUpdate">
                    <input class="col-2 p-1" type="text" id="max-textInput" value="600">
                  </div>
                </div>
              </div>
              <!-- Buscar -->
              <div class="container row align-items-center">
                <button type="submit" value="submit" class="btn btn-secondary col-12 col-sm-6 my-2">Buscar</button>
                <p class="hab-counter font-weight-light text-left col-12 col-sm-4 mb-2 mb-sm-0 px-0"><i>{{habitaciones.length}} estancias encontradas.</i></p>
              </div>
            </div>
        </form>
        <!--Nube de etiquetas -->
        <div class="nube-etiquetas container">
          <ul id="ListHabitaciones" class="hab-list list-unstyled list-inline text-left">
            <li class="list-inline-item" v-for="etiqueta in etiquetas">
                <span class="badge badge-pill badge-secondary px-4">{{etiqueta}}</span>
            </li>
          </ul>
        </div>
        
        <!--Lista de habitaciones -->
        <div class="hab-list-cont container">
          <ul id="ListHabitaciones" class="hab-list list-unstyled">
            <li v-for="item in habitaciones">
                <Habitacion :item="item" img="https://www.hotelmiguelangel.com/files/hotel/hotel-miguel-angel-madrid/HABITACION-STANDARD_1.jpg" :fecha="fecha"/>
            </li>
          </ul>
        </div>
        
    </div>
</template>

<script>
import Habitacion from '../Habitacion.vue'

export default {
  name: 'ListHabitaciones',
  data(){
    return {
      tipoEstancia : 0,
      precioMin: 0,
      precioMax: 600,
      fecha: null,
      errors: [],
      habitaciones: [],
      etiquetas:[]
    }
  } ,
  components: {
    Habitacion
  },
  created: async function(){
    this.getHabitaciones();
  },
  methods:{
    getHabitaciones: async function(){
      var res = await fetch('http://localhost:8000/api/estancias');
      var estancias = await res.json();

      var tipo_res = await fetch('http://localhost:8000/api/estancias');
      var tipos = await tipo_res.json();

      //Obtén el tipo de cada estancia
      estancias.forEach(function(hab){
        hab.tipo = tipos[hab.tipo_id - 1];
      });

      this.habitaciones = estancias;
    },
    rangeUpdate(event){
      //Cambia el valor del campo de text de los filtros de precio
      var textTarget;
      if(event.target.id == "sl-min"){
        textTarget = "min-textInput";
      }
      else{
        textTarget = "max-textInput";
      }
      document.getElementById(textTarget).value = event.target.value;
    },
    filtraEstancias: async function(e){
      e.preventDefault();
      this.actualizaEtiquetas();
      this.errors = [];

      //Verifica precios
      if(this.precioMin > this.precioMax){
        this.errors.push("El precio mínimo debe ser mayor que el máximo.");
      }

      //Verifica fecha
      if(this.fecha){
          var hoy = new Date();
          var d = new Date(this.fecha);

          if(hoy.getTime() > d.getTime()){
            this.errors.push("Seleccione una fecha válida.");
          }
      }

      if(this.errors.length == 0){
        await this.getHabitaciones();
        var d = new Date(this.fecha);
        var habs = this.habitaciones;
        var excluidas = [];

        console.log('Buscando reservas...');
        var res = await fetch('http://localhost:8000/api/estancias');
        var reservas = await res.json();
        
        //Comprobar disponibilidad
        reservas.forEach(function(reserva){
          var f_entrada = new Date(reserva.f_entrada);
          var f_salida = new Date(reserva.f_salida);
          if(f_entrada.getTime() <= d.getTime() && f_salida.getTime() >= d.getTime()){
            var ocupadas = habs.filter(function(item){
                return item.id == reserva.estancia_id;
              });

            excluidas.push(ocupadas[0]);
          }
        });

        var tipo = parseInt(this.tipoEstancia);
        var pmin = this.precioMin;
        var pmax = this.precioMax;
        habs.forEach(function(hab){
          if(tipo){
            if(tipo != hab.tipo_id){
              excluidas.push(hab);
            }

            var precio = hab.precio_base + hab.tipo.precio_tipo;
            if( precio < pmin || precio > pmax){
              excluidas.push(hab);
            }
          }
        });
        this.habitaciones = this.habitaciones.filter(function(i){return excluidas.indexOf(i) === -1});
      }
    },
    actualizaEtiquetas: function(){
      this.etiquetas = [];
      if(this.fecha) {this.etiquetas.push(this.fecha);}
      if(this.tipoEstancia) {this.etiquetas.push(this.getNombreTipo(parseInt(this.tipoEstancia)));}
      
      this.etiquetas.push(this.precioMin);
      this.etiquetas.push(this.precioMax);
    },
    getNombreTipo: function(tipoId){
      switch(tipoId){
        case 1: return "Sencilla";
        case 2: return "Doble";
        case 3: return "Suite";
        case 4: return "Sala de reuniones";
        default: return "Todas";
      }
    }
  }
}
</script>

<style scoped>
.hab-counter{
  font-size: 0.75rem;
  margin-left: 20px;
}

.range-picker{
  justify-content: space-between;
}

#min-textInput, #max-textInput{
  font-size:0.75rem;
  border:none;
  height: 75%;
  text-align: center;
}

form{
  background: #ddd;
  padding: 1rem 1rem 0 1rem;
  margin: 1rem;
}

form label{
  font-size: 0.8rem;
  margin-bottom: 0;
  font-weight: 600;
}

</style>