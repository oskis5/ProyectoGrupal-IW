<template>
    <div class="container-fluid">
        <!-- Filtros -->
        <form>
          <div class="container my-3">
            <div class="row align-content-between">
                <div class="form-group text-left col-12 col-sm-6">
                  <label for="date-picker">Fecha</label>
                  <input class="date-picker form-control mb-3" id="date-picker" type="date" name="bday">
                  <label for="type-sel">Tipo de estancia</label>
                  <select class="form-control" id="type-sel">
                    <option>Habitación</option>
                    <option>Sala de reuniones</option>
                  </select>
                </div>
                <!-- Precios -->
                <div class="form-group filter-container col-12 offset-sm-2 col-sm-4 px-0 text-left">
                  <label for="sl-min">Precio min.</label>
                  <div class="row range-picker align-content-between">
                    <input class="form-control col-8 p-0" id="sl-min" type="range" name="points" min="0" max="600" step="5" @input="rangeUpdate">
                    <input class="col-2 p-1" classtype="text" id="min-textInput" value="00" >
                  </div>

                  <label for="sl-max">Precio max.</label>
                  <div class="row range-picker text-left">
                    <input class="form-control col-8 p-0" id="sl-max" type="range" name="points" min="50" max="600" step="5"  @input="rangeUpdate">
                    <input class="col-2 p-1" type="text" id="max-textInput" value="00">
                  </div>
                </div>
              </div>
              <!-- Buscar -->
              <button type="button" class="btn btn-secondary colxs-12 offset-sm-8 col-sm-4 my-2">Buscar</button>
              <p class="hab-counter font-weight-light text-left"><i>{{habitaciones.length}} estancias encontradas.</i></p>
            </div>
        </form>
        
        <!--Lista de habitaciones -->
        <div class="hab-list-cont container">
          <ul class="hab-list list-unstyled">
            <li v-for="item in habitaciones">
                <Habitacion :item="item" img="https://www.hotelmiguelangel.com/files/hotel/hotel-miguel-angel-madrid/HABITACION-STANDARD_1.jpg"/>
            </li>
          </ul>
        </div>
        
    </div>
</template>

<script>
import Habitacion from '../Habitacion.vue'

export default {
  name: 'ListHabitaciones',
  props: ['habitaciones'],
  components: {
    Habitacion
  },
  created: async function(){
    var res = await fetch('http://localhost:8000/api/estancias');
    var estancias = await res.json();

    var tipo_res = await fetch('http://localhost:8000/api/tipoestancias');
    var tipos = await tipo_res.json();

    //Obtén el tipo de cada estancia
    estancias.forEach(function(hab){
      hab.tipo = tipos[hab.tipo_id - 1];
    });

    this.habitaciones = estancias;
  },
  methods:{
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
  font-size:0.8rem;
  border:none;
  background: #ddd;
  height: 75%;
}
</style>