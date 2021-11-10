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
                      <h3> Mis Consultas Recibidas </h3>
                   <table class="table table-striped table-sm">
                      
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Usuario</th>
                                
                                <th scope="col">Fecha</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                         
                              <tr v-for="consul in consultas.data" :key="consul.id">
                                <th scope="row">{{consul.id}}</th>
                                <td>{{consul.titulo}}</td>
                                <td>{{consul.cliente.name}}</td>
                               
                                <td>{{consul.created_at}}</td>
                                <td v-if="consul.estado == 1"><span class="badge bg-info badge-pill">Sin Responder</span></td>
                                <td v-if="consul.estado == 2 "><span class="badge bg-info badge-pill">Aceptada Esperando respuesta cliente</span></td>
                                <td v-if="consul.estado == 3"><span class="badge bg-info badge-pill">Rechazada</span></td>
                                <td v-if="consul.estado == 4"><span class="badge bg-info badge-pill">Aceptada y en marcha</span></td>
                                <td v-if="consul.estado == 5"><span class="badge bg-info badge-pill">Finalizada por el Cliente</span></td>
                                <td v-if="consul.estado == 6"><span class="badge bg-info badge-pill">Finalizada por Especialista</span></td>
                                <td v-if="consul.estado == 7"><span class="badge bg-info badge-pill">Cerrada</span></td>
                                <td>   
                                     <button type="button" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModal(consul);">
                                    Ver consulta
                                    </button>
                                    <button v-if="consul.estado == 1" type="button" class="btn btn-success btn-sm ms-2" data-bs-toggle="modal" :data-bs-target="'#aceptarModal'" @click="abrirModal(consul);">
                                      Aceptar y asignar precio
                                    </button>
                                   
                                      <a v-if="consul.estado != 1 && consul.sala_chat!=null"  class="btn btn-success btn-sm ms-2" @click="abrirChat(consul.id);" :href="route('chat')">Abrir chat</a>
                                      <button v-if="consul.estado >= 4 && consul.sala_chat==null" type="button" class="btn btn-success btn-sm ms-2" @click="nuevaSala(consul.id);">Crear Sala Chat</button>
                                    <button v-if="consul.estado == 1" type="button" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+consul.id">
                                       Rechazar 
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
                                            Seguro que desea rechazar la consulta <b>{{consul.titulo}}</b> del usuario {{consul.cliente.name}}
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
                        <!---->
                         <div class="modal fade" id="aceptarModal" tabindex="-1" aria-labelledby="aceptarModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="aceptarModal">Aceptar consulta y Asignar Precio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Usted esta a punto de aceptar la consulta con los siguientes detalles:<br>
                                    <b>Titulo Consulta: </b> {{consulta.titulo}}<br>
                                    <b>Usuario Consulta: </b>{{consulta.cliente}} <br>

                                    <h3 class="mt-4"><span class="">Asignar precio</span></h3>
                                    <div class="mb-3">
                                        
                                        <input v-model="aceptacion.precio" type="number" step="0.5" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">a este precio se le sumara un 20% dirigido a la empresa.</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" @click="guardarPrecio();">Asignar Precio</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!---->
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
                aceptacion:{
                    precio:'',
                    idConsulta:'',
                },              
                consulta:{
                    titulo:'',
                    consulta:'',
                    especialista:'',
                    especialidad:'',
                    fecha:'',
                    cliente:'',
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
                const res = await axios.get('/consultas/especialista/ver',{params:this.pagination,});
                this.consultas = res.data;
            },
            abrirModal(data={}){
        
                this.consulta.titulo=data.titulo;
                this.consulta.consulta=data.consulta;
                this.consulta.especialista = data.especialista.usuario.name;
                this.consulta.especialidad = data.especialista.especialidad.nombre;
                this.consulta.fecha = data.created_at;
                this.consulta.cliente = data.cliente.name;
                this.aceptacion.idConsulta = data.id;
            
            },
            async guardarPrecio(){
                const res = await axios.post('/consulta/precio/',this.aceptacion);      
                this.listar();     
            },
            async abrirChat(idConsulta){
                const res = await axios.post('/abrir/chat?idSala='+idConsulta);      
                this.listar();     
            },
            async nuevaSala(idConsulta){
                const res = await axios.post('/sala/nueva?idSala='+idConsulta);      
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
