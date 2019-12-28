<template>
    <div class="container">
        <h1>Esto es la lista de habitaciones</h1>
        <ul class="list-unstyled">
            <li v-for="item in habitaciones">
                <Habitacion :item="item" img="https://www.hotelmiguelangel.com/files/hotel/hotel-miguel-angel-madrid/HABITACION-STANDARD_1.jpg"/>
            </li>
        </ul>
    </div>
</template>

<script>
import Habitacion from './Habitacion.vue'

export default {
  name: 'listHabitaciones',
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