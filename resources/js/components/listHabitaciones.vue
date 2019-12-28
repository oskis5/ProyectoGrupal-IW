<template>
    <div class="container">
        <h1>Esto es la lista de habitaciones</h1>
        <Habitacion name="Habitación de ejemplo" img="https://www.hotelmiguelangel.com/files/hotel/hotel-miguel-angel-madrid/HABITACION-STANDARD_1.jpg" price="19.99$" description="Esto es una descripcion de ejemplo para una habitación con vistas al mar que no existe"/>
    </div>
</template>

<script>
import Habitacion from './Habitacion.vue'

export default {
  name: 'listHabitaciones',
  components: {
    Habitacion
  }
}
</script>