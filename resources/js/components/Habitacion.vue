<template>
    <div class="habitacion container p-3">
        <div class="row align-items-center">
            <img class="col-12 col-md-4 p-2" :src="img"/>
            <div class="col-12 col-md-6 info-habitacion text-left">
                <p class="hab-nombre text-uppercase"><strong>{{item.nombre}}</strong></p>
                <p class="hab-desc">{{item.descripcion}}</p>
                <p class="tipo-desc">{{item.tipo.descripcion}}</p>

                <!-- Render si es habitación -->
                <p v-if="item.tipo_id != 4" class="hab-detalles"><b>Camas:</b> {{item.camas}}</p>
                <p v-if="item.tipo_id != 4" class="hab-detalles"><b>Tamaño:</b> {{item.metros_cuadrados}} metros cuadrados</p>

                <!-- Render si es sala de reuniones -->
                <p v-if="item.tipo_id == 4" class="hab-detalles"><b>Capacidad:</b> {{item.capacidad}} personas</p>
            </div>
        </div>

        <!--Precio y selector de estancia-->
        <div class="row justify-content-center align-items-center">
            <select class="selectpicker tipo-reserva-select col-4">
                <option value="completa">Pensión completa</option>
                <option value="media">Media pensión</option>
            </select> 
            <p class="hab-precio col-6"><strong>{{item.precio_base + item.tipo.precio_tipo}}€</strong></p>
            <button type="button" class="hab-boton-reserva btn btn-secondary col-2">Reservar</button>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Habitacion',
  props: ['item','img']
}
</script>