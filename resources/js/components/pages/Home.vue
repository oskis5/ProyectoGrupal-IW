<template>
    <div class="container pw-3 home-container justify-content-center">

      <div class="carousel-content container justify-content-center align-items-center">
        <div class="container mx-0 p-0">
          <div class="col-12">
            <h1 class="text-center">Bienvenido al</br>Hotel Politécnico</h1>
            <h2 class="text-center">Encuentra tu habitación ahora</h2>
          </div>
          
          <div class="col-12">
            <form>
              <div class="row justify-content-center align-items-center">
                <div class="form-group text-left col-12 col-sm-4">
                  <label for="date-picker">Fecha de entrada</label>
                  <input v-model="fecha" class="date-picker form-control mb-3" id="date-picker" type="date" name="bday">
                </div>
                <div class="form-group text-left col-12 col-sm-4">
                  <label for="date-picker">Fecha de salida</label>
                  <input v-model="fecha" class="date-picker form-control mb-3" id="date-picker" type="date" name="bday">
                </div>
              </div>
              
              <div class="form-group text-left col-12 col-sm-6 justify-content-center align-items-center">
                <label for="type-sel">Tipo de estancia</label>
                  <select v-model="tipoEstancia" class="form-control" id="type-sel">
                    <option value="0">Todas</option>
                    <option value="1">Sencilla</option>
                    <option value="2">Doble</option>
                    <option value="3">Suite</option>
                    <option value="4">Sala de reuniones</option>
                  </select>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Slider imagenes -->
      <div class="row justify-content-center mb-4">
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
        <h3 class="text-left text-uppercase col-12 mb-0 mt-3">Nuestras habitaciones</h3>
        <div class="row justify-content-center cards-container p-4">
          <div v-for="t in tipoEstancias" class="card px-0 tipo-card col-12 col-sm-3 mb-3">
            <img class="card-img-top" v-bind:src="t.img" alt="Card image cap">
            <div class="px-0 pt-0 card-body">
              <div class="col-12 p-1 tipo-titulo justify-content-center align-items-center p-3">
                <p class="mb-0"><b>{{t.nombre}}</b></p>
              </div>
              <p class="p-2">{{t.descripcion}}</p>
              <a href="#" class="btn btn-secondary align-self-end">Desde {{t.precio_tipo}}€/noche</a>
            </div>
          </div>
        </div>
        <!-- Mapa -->
        <div class="map-container container mt-4" id="Home">
          <h3 class="text-left text-uppercase col-12 mb-0 mt-3 p-0">Dónde encontrarnos</h3>
          <p class="text-left">Ubicación privilegiada en el centro de Alicante a 5 minutos de la playa y
            buena conexión con transporte público.
          </p>
          <img alt="Localización" v-bind:src="'images/mapa.PNG'" class="img-fluid">
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
      var res = await fetch('http://localhost/ProyectoGrupal-IW/public/api/tipoestancias');
      var tipos = await res.json();

      this.tipoEstancias = tipos.slice(0, 3);
      this.tipoEstancias[0].img = "https://s7d2.scene7.com/is/image/ritzcarlton/50554432-Junior%20Suite%20Ocean%20View%20bedroom%20corner?$XlargeViewport100pct$";
      this.tipoEstancias[1].img = "https://www.hotelprismabarcelona.com/wp-content/uploads/2018/04/Habitacio%CC%81n-Doble-cama-matrimonio-2_192.jpg";
      this.tipoEstancias[2].img = "https://media-cdn.tripadvisor.com/media/photo-s/0e/a2/c1/9a/detalle-de-la-habitacion.jpg";
  }
}
</script>

<style scoped>
  .carousel{
    background:#222;
  }

  .carousel img{
    opacity: 0.7;
  }
  .carousel-inner{
    overflow:hidden;
    max-height: 400px;
  }

  .tipo-card{
    margin:0 1rem 0 1rem;
    box-shadow: gray 2px 2px 4px;
  }

  .tipo-card img{
    max-height: 150px; 
  }

  .cards-container{
    margin-top: 1.5rem;
    background: #bbb;
  }

  .tipo-titulo{
    background: #ccc;
  }

  .map-container img:hover{
    width: 100%;
    transition: all ease 0.4ms;
  }

  .carousel-content{
    display:flex;
    position:absolute;
    z-index:1;
    margin: auto 0 auto 0;
    height: 400px;
  }

  .carousel-content h1, h2{
    font-size: 1.8rem;
    color:#eee;
    font-weight: 600;
    text-transform: uppercase;
  }

  .carousel-content h2{
    font-size: 1rem;
  }

  label{
    color: white;
    margin: 0;
  }

  @media only screen and (max-width: 690px) {
    .carousel-content{
      height: 200px;
    } 
  }
</style>