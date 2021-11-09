<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Consultas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="p-4">
                      <h3> Mis Consultas realizadas </h3>
                   <table class="table table-striped table-sm">
                      
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Especialista</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                         
                              <tr v-for="consul in consultas.data" :key="consul.id">
                                <th scope="row">{{consul.id}}</th>
                                <td>{{consul.titulo}}</td>
                                <td>{{consul.especialista.usuario.name}}</td>
                                <td>{{consul.especialista.especialidad.nombre}}</td>
                                <td>{{consul.created_at}}</td>
                                <td v-if="consul.estado == 1">Sin Responder</td>
                                <td v-if="consul.estado == 2">Aceptada</td>
                                <td v-if="consul.estado == 3">Rechazada</td>
                                <td v-if="consul.estado == 3">Finalizada</td>
                                <td>   
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModal(consul);">
                                    Ver consulta
                                    </button>
                                      <a v-if="consul.estado != 1 && consul.sala_chat!=null" type="button" class="btn btn-primary btn-sm ms-2"  @click="abrirChat(consul.id);" :href="route('chat')">Abrir chat</a>
                                    <button type="button" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+consul.id">
                                        Eliminar
                                    </button>
                                      
                                </td>
                                 <!-- Modal -->
                                <div class="modal fade" :id="'eliminarModal_'+consul.id"  tabindex="-1" :aria-labelledby="'eliminarModalLabel_'+consul.id" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'eliminarModalLabel_'+consul.id">Seguro que due desea eliminar este registro?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea eliminar el registro <b>{{consul.titulo}}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" @click="eliminar(consul.id);" data-bs-dismiss="modal">Si, Eliminar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Fin Modal eliminar-->
                            </tr>
                        </tbody>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ver consulta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Titulo</b></h5>
                                    <h6>{{consulta.titulo}}</h6>
                            
                                    <h5><b>Especialista</b></h5>
                                    <h6>{{consulta.especialista}}</h6>

                                    <h5><b>Tipo</b></h5>
                                    <h6>{{consulta.especialidad}}</h6>

                                    <h5><b>Fecha realización</b></h5>
                                   <h6>{{consulta.fecha}}</h6>

                                    <h5><b>Consulta</b></h5>
                                    <p>{{consulta.consulta}}</p>

                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'


    export default {
        components: {
            AppLayout,
            
           
        },
        data(){ 
            return{
                 consulta:{
                    titulo:'',
                    consulta:'',
                    especialista:'',
                    especialidad:'',
                    fecha:'',
                },
                id:0,
                modificar:true,
                modal:0,
                consultas:[],
                pagination:{
                    page:1,
                    per_page:5,

                },
            }
        }, 
        methods:{
            async listar(){
                const res = await axios.get('/consultas/cliente/ver',{params:this.pagination,});
                this.consultas = res.data;
            },
            abrirModal(data={}){
                
                if(this.modificar){
                 
                    this.consulta.titulo=data.titulo;
                    this.consulta.consulta=data.consulta;
                    this.consulta.especialista = data.especialista.usuario.name;
                    this.consulta.especialidad = data.especialista.especialidad.nombre;
                    this.consulta.fecha = data.created_at;
                }
                else{
                     this.consulta.titulo='';
                    this.consulta.consulta='';
                    this.consulta.especialista =''; 
                    this.consulta.especialidad =''; 
                    this.consulta.fecha = '';
                }
            },
             async abrirChat(idConsulta){
                const res = await axios.post('/abrir/chat?idSala='+idConsulta);      
                this.listar();     
            },
            cerrarModal(){
                this.modal=0;
                this.errores={};
            },
            async eliminar(id){
                const res = await axios.delete('/consultas/'+id);
                this.cerrarModal();
                this.listar();

            },
        },
        
        created(){
            this.listar();
        },
        
        
    }
</script>
