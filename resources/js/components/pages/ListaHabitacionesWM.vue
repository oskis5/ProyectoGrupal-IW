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
        
        <template v-slot:cell(nombre)="data">
           {{ data.item.nombre }}
        </template>
        <template v-slot:cell(planta)="data">
           {{ data.item.planta }} 
        </template>
        <template v-slot:cell(puerta)="data">
           {{ data.item.puerta }}
        </template>
        <template v-slot:cell(reservada)="data">
            <p v-if="data.item.reservada == 0" class="text-xs-center">No</p>
            <p v-if="data.item.reservada == 1" class="text-xs-center">Sí</p>
        </template>
        <template  v-slot:cell(tipo_id)="data" >
            <p v-if="data.item.tipo_id == 1" class="text-xs-center">Sencilla</p>
            <p v-if="data.item.tipo_id == 2" class="text-xs-center">Doble</p>
            <p v-if="data.item.tipo_id == 3" class="text-xs-center">Suite</p>
            <p v-if="data.item.tipo_id == 4" class="text-xs-center">Sala reuniones</p>
        </template>
        <template v-slot:cell(precio_base)="data">
           {{ data.item.precio_base }} €
        </template>
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
                    <b-form-group label="Nombre:" description="" >
                        <b-form-input name="nombre" v-model="nombre" type="text"></b-form-input>
                    </b-form-group>
                    <b-form-group label="Descripción:" description="" >
                        <b-form-textarea name="descripcion" v-model="descripcion" ></b-form-textarea>
                    </b-form-group>
                    <b-row>
                        <b-col>
                            <b-form-group label="Planta:" description="" >
                                <b-form-input name="planta" v-model="planta" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group label="Puerta:" description="" >
                                <b-form-input name="puerta" v-model="puerta" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col>
                            <b-form-group label="Precio:" description="" >
                                <b-form-input name="precio_base" v-model="precio_base" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group label="Tipo :" description="" >
                                <b-form-select name="tipo_id" v-model="tipo_id" :options="opciones" ></b-form-select>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row v-if="tipo_id != 0 && tipo_id != 4">
                        <b-col>
                            <b-form-group  label="Camas:" description="">
                                <b-form-input  name="camas" v-model="camas" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group label="Metros^2:" description="">
                                <b-form-input  name="metros" v-model="metros_cuadrados" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-form-group v-if="tipo_id == 4" label="Capacidad:" description="">
                        <b-form-input  name="capacidad" v-model="capacidad" type="text"></b-form-input>
                    </b-form-group>
                    
                    <b-button ref="btnguardar" size="lg" block pill variant="success" v-on:click="create()" class="mt-5">Guardar</b-button>
                </b-card>
            </b-form>
        </b-modal>

        <b-modal ref="modal-editar" id="modal-editar" title="Editar Habitación" hide-footer>
            <b-form >
                <b-card >
                <b-row>
                    <b-col>
                        <b-form-group label="Nombre:" description="" >
                            <b-form-input name="nombre" v-model="editedItem.nombre" type="text"></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group label="Reservada:" description="" >
                            <b-form-radio-group
                                id="btn-radios-2"
                                v-model="editedItem.reservada"
                                :options="options"
                                name="radio-inline"
                            ></b-form-radio-group>
                        </b-form-group>
                    </b-col>
                </b-row>
                    <b-form-group label="Descripción:" description="" >
                        <b-form-textarea name="descripcion" v-model="editedItem.descripcion" required></b-form-textarea>
                    </b-form-group>
                   
                    <b-row>
                        <b-col>
                            <b-form-group label="Planta:" description="" >
                                <b-form-input name="planta" v-model="editedItem.planta" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group label="Puerta:" description="" >
                                <b-form-input name="puerta" v-model="editedItem.puerta" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col>
                            <b-form-group label="Precio:" description="" >
                                <b-form-input name="precio_base" v-model="editedItem.precio_base" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group label="Tipo:" description="" >
                                <b-form-select name="tipo_id" v-model="editedItem.tipo_id" :options="opciones" ></b-form-select>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row v-if="editedItem.tipo_id != 0 && editedItem.tipo_id != 4">
                        <b-col>
                            <b-form-group label="Camas:" description="">
                                <b-form-input  name="camas" v-model="editedItem.camas" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group label="Metros^2:" description="">
                                <b-form-input  name="metros" v-model="editedItem.metros_cuadrados" type="text"></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                            <b-form-group v-if="editedItem.tipo_id == 4" label="Capacidad:" description="">
                                <b-form-input  name="capacidad" v-model="editedItem.capacidad" type="text"></b-form-input>
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
                nombre: "",
                puerta: null,
                planta: null,
                descripcion: ' ',
                camas: null,
                precio_base: null,
                tipo_id: "",
                metros_cuadrados: null,
                capacidad: null,
                reservada: null,
                tipoHabitacion: "",
                striped: true,
                bordered: true,
                borderless: true,
                hover: true,
                sortBy: 'name',
                sortDesc: false,
                perPage: 5,
                currentPage: 1,
                headers:  [
                    {label: 'Nombre', key: 'nombre', sortable: true},
                    {label: 'Planta', key: 'planta', sortable: true},
                    {label: 'Puerta', key: 'puerta', sortable: true},
                    {label: 'Reservada', key: 'reservada', sortable: true},
                    {label: 'Tipo', key: 'tipo_id', sortable: true},
                    {label: 'Precio', key: 'precio_base', sortable: true},
                    {label: 'Opciones', key: 'opciones'},
                ],
                habitaciones: [],
                editedItem: {
                    id: null,
                    nombre: "",
                    puerta: null,
                    planta: null,
                    descripcion: ' ',
                    camas: 0,
                    precio_base: null,
                    tipo_id: "",
                    metros_cuadrados: 0,
                    capacidad: 0,
                    reservada: null,
                },
                opciones: [
                    { value: 1, text: 'Sencilla' },
                    { value: 2, text: 'Doble' },
                    { value: 3, text: 'Suite' },
                    { value: 4, text: 'Sala reuniones' },
                ],
                options: [{text: 'Sí', value: 1},
                        {text: 'No', value: 0}
                ]
            }
        },
        computed: {
            rows() {
                return this.habitaciones.length
            },
        },
        methods: {
            create(){
                
                axios.post('api/estancias', {
                    nombre: this.nombre,
                    planta: this.planta,
                    puerta: this.puerta,
                    descripcion: this.descripcion,
                    precio_base: this.precio_base,
                    tipo_id: this.tipo_id,
                    reservada: 0,
                    metros_cuadrados: ((this.metros_cuadrados != null)? this.metros_cuadrados: 0),
                    camas: ((this.camas != null)? this.camas: 0),
                    capacidad: ((this.capacidad != null)? this.capacidad: 0), 
                 
                }).then(response=> {
                        this.$root.$emit('bv::hide::modal', 'modal-crear', '#btnguardar'); 
                        location.reload();
                        this.$refs.recargar.refresh();
                    }).catch(error => {
                        console.log(error);
                    });
            },
            update(){
                axios.put('api/estancias/'+ this.editedItem.id,{
                    nombre: this.editedItem.nombre,
                    planta: this.editedItem.planta,
                    puerta: this.editedItem.puerta,
                    descripcion: this.editedItem.descripcion,
                    precio_base: this.editedItem.precio_base,
                    tipo_id: this.editedItem.tipo_id,
                    reservada: this.editedItem.reservada,
                    metros_cuadrados: this.editedItem.metros_cuadrados,
                    camas: this.editedItem.camas,
                    capacidad: this.editedItem.capacidad,
                })
                .then(response=> {
                        this.$root.$emit('bv::hide::modal', 'modal-crear', '#btnguardar'); 
                        location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
            },
            destroy(id){
                axios.delete('api/estancias/'+ id)
                .then(response=> {
                        location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
            },
            editItem(item){
                this.$refs['modal-editar'].show();
                console.log(item);
                this.editedItem.id = item.id
                this.editedItem.nombre = item.nombre
                this.editedItem.planta = item.planta
                this.editedItem.puerta = item.puerta
                this.editedItem.descripcion = item.descripcion
                this.editedItem.precio_base = item.precio_base
                this.editedItem.tipo_id = item.tipo_id
                this.editedItem.reservada = item.reservada
                this.editedItem.metros_cuadrados = item.metros_cuadrados
                this.editedItem.camas = item.camas
                this.editedItem.capacidad = item.capacidad
            },
        },
        mounted() {
            axios.get('api/estancias')
            .then(response => {
                    this.habitaciones = response.data;
                }).catch(error => {
                    console.log(error);
                });    
        },
    }
</script>