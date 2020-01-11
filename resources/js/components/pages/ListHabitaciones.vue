<template>
    <div class="container-fluid">
        <!-- Filtros -->
        <form>
          <div class="container my-3">
            <div class="row align-items-center">
                <div class="form-group text-left col-xs-12 col-8">
                  <label for="date-picker">Fecha</label>
                  <input class="date-picker form-control mb-3" id="date-picker" type="date" name="bday">
                  <label for="type-sel">Tipo de estancia</label>
                  <select class="form-control" id="type-sel">
                    <option>Habitación</option>
                    <option>Sala de reuniones</option>
                  </select>
                </div>
                <div class="container form-group filter-container text-left col-xs-12 col-3">
                  <label for="sl-min">Precio min.</label>
                  <input class="form-control col-12" id="sl-min" type="range" name="points" min="0" max="10">
                  <label for="sl-max">Precio max.</label>
                  <input class="form-control col-12" id="sl-max" type="range" name="points" min="0" max="10">
                  <button type="button" class="btn btn-secondary col-12">Buscar</button>
                </div>
              </div>
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
    this.habitaciones = estancias;
  }
}
</script>