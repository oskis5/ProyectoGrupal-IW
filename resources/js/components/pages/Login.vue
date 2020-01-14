<template>
    <div>
        <b-form class="w-50 mx-auto" style="padding: 6vh 10vw">
            <b-card class="p-2" bg-variant="light">
                
                <img alt="Vue logo" :src="'images/logo-h.png'" class="img-fluid" style="height: 170px">
                    
                <b-form-group label="Correo electrónico:" style="margin-top: 10%">
                    <b-form-input name="email" v-model="email" type="email" placeholder="example@gmail.com"></b-form-input>
                </b-form-group>

                <b-form-group label="Contraseña:" description="La contraseña debe tener un mínimo de 6 caracteres" class="mt-5">
                    <b-form-input name="password" v-model="password" type="password"></b-form-input>
                </b-form-group>
                
                <b-spinner v-if="status == 'loading'" label="Spinning" style="margin-top: 10%"></b-spinner>

                <b-button size="lg" pill block variant="success" v-on:click="login()" class="mx-auto mt-5 mb-3" style="width: 200px">Iniciar sesión</b-button>
                <router-link :to="{name: 'register'}">Registrarse</router-link>
                
            </b-card>
        </b-form>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data(){
        return {
            email : "",
            password : "",
            toastCount: 0
        }
    },
    computed : {
        status : function(){ return this.$store.getters.status }
    },
    methods: {
        login: function() {
            let data = {
                email: this.email,
                password: this.password
            }
            if (this.email == "" || this.password == "") {
                this.makeToast(`No puedes dejar campos vacíos.`)
            } else {
                this.$store.dispatch('login', data)
                .then(() => this.$router.push('/ProyectoGrupal-IW/public/'))
                .catch( () => {
                    this.makeToast(`El usuario con correo electrónico ${this.email} no es correcto.`)
                })
            }    
        },
        makeToast(message) {
        this.toastCount++
        this.$bvToast.toast(message, {
            title: 'Error en el inicio de sesión',
            autoHideDelay: 5000,
            variant: 'danger',
            toaster: 'b-toaster-bottom-center'
        })
      }
    }
}
</script>