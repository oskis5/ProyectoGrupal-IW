<template>
  <div>
    <b-form class="w-50 mx-auto" style="padding: 6vh 10vw">
      <b-card class="p-2" bg-variant="light">
        
        <img alt="Vue logo" :src="'images/logo-h.png'" class="img-fluid" style="height: 170px">
        
        <b-form-group label="Nombre de usuario:" description="No puede superar los 15 caracteres" class="mt-3">
          <b-form-input name="username" v-model="username" type="text"></b-form-input>
        </b-form-group>

        <div class="row">
          <div class="col">
            <b-form-group label="Nombre:" description="">
              <b-form-input name="name" v-model="name" type="text"></b-form-input>  
            </b-form-group>
          </div>
          <div class="col">
            <b-form-group label="Apellidos:" description="">
              <b-form-input name="surname" v-model="surname" type="text"></b-form-input>
            </b-form-group>
          </div>
        </div>

        <b-form-group label="Correo electrónico:" description="" class="mt-3">
          <b-form-input name="email" v-model="email" type="email" placeholder="email@example.com"></b-form-input>
        </b-form-group>

        <b-form-group label="Contraseña:" description="La contraseña debe tener un mínimo de 6 caracteres" class="mt-4">
          <b-form-input name="password" v-model="password" type="password" placeholder="******"></b-form-input>
        </b-form-group>
      
        <b-button size="lg" block pill variant="success" v-on:click="register()" class="mt-5">Continuar</b-button>
      </b-card>
    </b-form>
  </div>
</template>

<script>

export default {
  name: 'Register',
  data(){
    return {
      name: "",
      surname: "",
      username: "",
      email: "",
      password: "",
    }
  },
  methods: {
    register: function () {
      let data = {
        name: this.name,
        surname: this.surname,
        username: this.username,
        email: this.email,
        password: this.password
      }
      this.$store.dispatch('register', data)
      .then(() => this.$router.push('/login'))
      .catch(err => console.log(err))
    }
  }
}
</script>
