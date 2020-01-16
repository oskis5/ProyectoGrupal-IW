<template>
    <div class="container pw-3 home-container justify-content-center">
      <!-- Slider imagenes -->
      <div class="row justify-content-center">
          <div class="carousel slide col-12 px-0" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="https://r-cf.bstatic.com/images/hotel/max1024x768/107/107157832.jpg" alt="Cereales">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://r-cf.bstatic.com/images/hotel/max1024x768/102/102096979.jpg" alt="Cocina">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://q-cf.bstatic.com/images/hotel/max1024x768/107/107158101.jpg" alt="Vistas">
              </div>
            </div>
          </div>
        </div>

        <!-- Tipo habitaciones -->
        <div class="row justify-content-center cards-container p-4">
          <div v-for="t in tipoEstancias" class="card px-0 tipo-card col-3">
            <img class="card-img-top" src="https://www.hotelprismabarcelona.com/wp-content/uploads/2018/04/Habitacio%CC%81n-Doble-cama-matrimonio-2_192.jpg" alt="Card image cap">
            <div class="px-0 pt-0 card-body">
              <div class="col-12 p-1 tipo-titulo justify-content-center align-items-center p-3">
                <p class="mb-0"><b>{{t.nombre}}</b></p>
              </div>
              <p class="p-2">{{t.descripcion}}</p>
              <a href="#" class="btn btn-secondary align-self-end">Desde {{t.precio_tipo}}€/noche</a>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  name: 'Home',
  data(){
    return {
      tipoEstancias: []
    }
  },
  created: async function(){
      var res = await fetch('http://localhost:8000/api/tipoestancias');
      var tipos = await res.json();

      this.tipoEstancias = tipos.slice(0, 3);
  }
}
</script>

<style scoped>
  .carousel-inner{
    overflow:hidden;
    max-height: 400px;
  }

  .tipo-card{
    margin:0 1rem 0 1rem;
  }

  .tipo-card img{
    max-height: 150px; 
  }

  .cards-container{
    margin-top: 1.5rem;
    background: #eee;
  }

  .tipo-titulo{
    background: #bbb;
  }
</style>