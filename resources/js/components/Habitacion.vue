<template>
    <div class="habitacion container p-3">
        <!-- Parte la tarjeta en dos, arriba la foto y la info, abajo precio y selección de tipo de estancia -->
        <div class="row align-items-center">
            <img class="col-4 p-2" :src="img"/>
            <div class="col-6 info-habitacion text-left">
                <p class="hab-nombre text-uppercase"><strong>{{name}}</strong></p>
                <p class="hab-desc">{{description}}</p>
            </div>
        </div>

        <!--Precio y selector de estancia-->
        <div class="row justify-content-center align-items-center">
            <select class="selectpicker tipo-reserva-select col-4">
                <option value="completa">Pensión completa</option>
                <option value="media">Media pensión</option>
            </select> 
            <p class="hab-precio col-6"><strong>{{price}}</strong></p>
            <button type="button" class="hab-boton-reserva btn btn-secondary col-2">Reservar</button>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Habitacion',
  props: [
      'name',
      'img',
      'description',
      'price'
  ]
}
</script>