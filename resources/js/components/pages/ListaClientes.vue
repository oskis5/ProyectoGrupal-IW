<template> 
    <b-container style= "margin-top: 5%">
        <div align="right">
            <b-button v-b-modal.modal-1 variant="success" class="mb-2">Nuevo cliente</b-button>
        </div>
        <b-table 
        :striped="striped"
        :bordered="bordered"
        :hover="hover"
        :borderless="borderless"
        :fields="headers"
        :items="clientes"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        sort-icon-left
        responsive="sm"
        :per-page="perPage"
        :current-page="currentPage"
        >
        <!--<template >
            <tr v-for="cliente of clientes">
                <td class="text-xs-center">{{ cliente.name }}</td>
                <td class="text-xs-center">{{ cliente.email }}</td>
                <td>
               
                <b-button v-b-modal.modal-1 variant="success" class="mb-2">Nuevo cliente</b-button>
                </td>                       
            </tr>
        </template>-->
        <template v-slot:cell(opciones)="row">
            <b-button size="sm" variant="warning" class="mr-1">
            Editar
            </b-button>
            <b-button size="sm" variant="danger" class="mr-1">
            Eliminar
            </b-button>
        </template>
   
        </b-table>
        <b-pagination style= "aling-items: center; justify-content: center"
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
        ></b-pagination>
        <b-modal id="modal-1" title="Nuevo cliente" hide-footer>
    
            <b-form >
                <b-card >
                    <!--<div class="row">
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
                    </div>-->
                       
                    <b-form-group label="Nombre:" description="" class="mt-3">
                        <b-form-input name="name" v-model="name" type="text"></b-form-input>
                    </b-form-group>
                
                    <b-form-group label="Correo electrónico:" description="" class="mt-3">
                        <b-form-input name="email" v-model="email" type="email" placeholder="email@example.com"></b-form-input>
                    </b-form-group>
                    <b-form-group label="Contraseña:" description="La contraseña debe tener un mínimo de 6 caracteres" class="mt-4">
                        <b-form-input name="password" v-model="password" type="password" placeholder="******"></b-form-input>
                    </b-form-group>
                    <b-button ref="btnguardar" size="lg" block pill variant="success" v-on:click="create()" class="mt-5">Guardar</b-button>
                </b-card>
            </b-form>
            <b-button class="mt-3" block @click="$bvModal.hide('modal-1')">Close Me</b-button>
        </b-modal>
      
    </b-container>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                name: "",
                email: "",
                password: "",
                striped: true,
                bordered: true,
                borderless: true,
                hover: true,
                sortBy: 'name',
                sortDesc: false,
                perPage: 5,
                currentPage: 1,
                headers:  [
                {label: 'Nombre', key: 'name', sortable: true},
                {label: 'Email', key: 'email', sortable: true},
                {label: 'Opciones', key: 'opciones'},
                ],
                clientes: []
            }
        },
        computed: {
            rows() {
                return this.clientes.length
            },
           /* hideModal() {
                this.$root.$emit('bv::hide::modal', 'modal-1', '#btnguardar')
            },*/
        },
        methods: {
            create(){
                /*axios.post('api/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }).then(response=> {
                        this.$router.push('listaClientes');
                    }).catch(error => {
                        console.log(error);
                    });*/
            }
        },
        mounted() {
            axios.get('api/users')
            .then(response => {
                    this.clientes = response.data;
                }).catch(error => {
                    console.log(error);
                });    
        },
    }
</script>