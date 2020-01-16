<template> 
    <b-container style= "margin-top: 5%">
        <div align="right">
            <b-button v-b-modal.modal-crear variant="success" class="mb-2">Nueva</b-button>
        </div>
        <b-table 
        :striped="striped"
        :bordered="bordered"
        :hover="hover"
        :borderless="borderless"
        :fields="headers"
        :items="habitaciones"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        sort-icon-left
        responsive="sm"
        :per-page="perPage"
        :current-page="currentPage"
        >
        <!--<template >
            <tr v-for="habitacion of habitaciones">
                <td class="text-xs-center">{{ habitacion.name }}</td>
                <td class="text-xs-center">{{ habitacion.email }}</td>
                <td>
               
                <b-button v-b-modal.modal-crear variant="success" class="mb-2">Nuevo habitacion</b-button>
                </td>                       
            </tr>
        </template>-->
        <template v-slot:cell(opciones)="row">
            <b-button  size="sm" variant="warning" v-on:click="editItem(row.item)" class="mr-1">
            Editar
            </b-button>
            <b-button size="sm" variant="danger" v-on:click="destroy(row.item.id)" class="mr-1">
            Eliminar
            </b-button>
        </template>
   
        </b-table>
        <b-pagination style= "aling-items: center; justify-content: center"
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
        ></b-pagination>
        <b-modal id="modal-crear" title="Nueva Habitación" hide-footer>
            <b-form >
                <b-card >
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
        </b-modal>

        <b-modal ref="modal-editar" id="modal-editar" title="Editar Habitación" hide-footer>
            <b-form >
                <b-card >
                    <b-form-group label="Nombre:" description="" class="mt-3">
                        <b-form-input name="name" v-model="editedItem.name" type="text"></b-form-input>
                    </b-form-group>
                    <b-form-group label="Correo electrónico:" description="" class="mt-3">
                        <b-form-input name="email" v-model="editedItem.email" type="email" placeholder="email@example.com"></b-form-input>
                    </b-form-group>
                    <b-button ref="btnguardar" size="lg" block pill variant="success" v-on:click="update()" class="mt-5">Guardar</b-button>
                </b-card>
            </b-form>
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
                roles: "",
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
                habitaciones: [],
                editedItem: {
                    id: null,
                    name: "",
                    email: "",
                    password: "",
                    roles: 'habitacion'
                },
            }
        },
        computed: {
            rows() {
                return this.habitaciones.length
            },
        },
        methods: {
            create(){
                axios.post('api/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    roles: 'habitacion',
                }).then(response=> {
                        //this.$router.push({ name: 'listahabitaciones' })
                        this.$root.$emit('bv::hide::modal', 'modal-crear', '#btnguardar');
                        //this.$forceUpdate(); 
                        location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
            },
            update(){
                axios.put('api/users/'+ this.editedItem.id,{
                    name: this.editedItem.name,
                    email: this.editedItem.email,
                    password: this.editedItem.password,
                    roles: 'habitacion',
                })
                .then(response=> {
                        this.$root.$emit('bv::hide::modal', 'modal-crear', '#btnguardar'); 
                        location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
            },
            destroy(id){
                axios.delete('api/users/'+ id)
                .then(response=> {
                        location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
            },
            editItem(item){
                this.$refs['modal-editar'].show();
                this.editedItem.id = item.id
                this.editedItem.name = item.name
                this.editedItem.email = item.email
                this.editedItem.password = item.password
            }
        },
        mounted() {
            axios.get('api/users')
            .then(response => {
                    this.habitaciones = response.data;
                }).catch(error => {
                    console.log(error);
                });    
        },
    }
</script>