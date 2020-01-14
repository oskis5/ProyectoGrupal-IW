<template>
    <div class="habitacion container">
        <div class="row align-items-center py-0 py-m-2">
            <img class="col-12 col-md-4 p-2" :src="img"/>
            <div class="col-12 col-md-6 info-habitacion text-left">
                <p class="hab-nombre text-uppercase py-2"><strong>{{item.nombre}}</strong></p>
                <p class="hab-desc">{{item.descripcion}}</p>
                <p class="tipo-desc">{{item.tipo.descripcion}}</p>

                <!-- Render si es habitación -->
                <p v-if="item.tipo_id != 4" class="hab-detalles"><b>Camas:</b> {{item.camas}}</p>
                <p v-if="item.tipo_id != 4" class="hab-detalles"><b>Tamaño:</b> {{item.metros_cuadrados}} metros cuadrados</p>
                <p v-if="item.tipo_id != 4" class="hab-detalles"><b>Tipo:</b> {{item.tipo.nombre}}</p>

                <!-- Render si es sala de reuniones -->
                <p v-if="item.tipo_id == 4" class="hab-detalles"><b>Capacidad:</b> {{item.capacidad}} personas</p>
            </div>
        </div>

        <!--Precio y selector de estancia-->
        <div class="row price-row justify-content-start justify-content-sm-center align-items-center">
            <select v-model="tipoPension" class="selectpicker tipo-reserva-select col-6 col-sm-4">
                <option value="1">Solo alojamiento</option>
                <option value="2">Desayuno incluido</option>
                <option value="3">Media pensión</option>
                <option value="4">Pensión completa</option>
            </select> 
            <p class="hab-precio col-2 offset-2 offset-sm-0 col-sm-6 my-0"><strong>{{item.precio_base + item.tipo.precio_tipo}}€</strong></p>
            <button type="button" class="hab-boton-reserva btn btn-secondary col-12 mt-3 mt-sm-0 col-sm-2">
                <router-link :to="{ name: 'reservas', params: { tipoPension: this.tipoPension , fecha: this.fecha, tipoHab: this.item.tipo.id}}">
                    Reservar
                </router-link>
            </button>
            
            
        </div>
    </div>
</template>

<script>
export default {
  name: 'Habitacion',
  props: ['item','img', 'fecha'],
  data(){
      return{
          tipoPension: 2
      }
  }
}
</script>

<style>
.habitacion{
  padding: 0rem 1rem 0 1rem !important;
  background: #ddd;
  margin-bottom: 1.75rem;
}

.habitacion:hover{
  background: #eee;
  transform: scale(1.01);
  transition: all ease 0.3ms;
}

.habitacion select{
    padding: 0.75rem;
    font-family: inherit;
    font-weight: inherit;
}

.price-row{
    background:#bbb;
    padding: 1rem;
}

.price-row select, .price-row button{
    font-size: 0.8rem;
    font-weight: 400;
    padding: 0.65rem 0.25rem;
}

.price-row button a{
    color: white !important;
}
</style>