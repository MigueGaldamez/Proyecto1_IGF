<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               <!--<sala-chat-seleccion
               
               v-if="salaActual.id"
               :salas="salasChat"
               :salaActual="salaActual"
               v-on:salaChanged="setSala($event)"/>-->
             
               <div class="grid grid-cols-2">
                    <div class="font-bold text-xl">
                          {{salaActual.nombreSala}} Chat
                    </div>
                    <div>
                        
                    </div>

                </div>
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg chat">
                    <div class="row">
                        <div class="col col-4 border-2 p-4">
                           
                            Otras conversaciones
                            <ol class="list-group mx-auto">
                                  <li class="list-group-item d-flex justify-content-between align-items-start" v-for="sala in salasChat" :key="sala.id" @click="setSala(sala);">
                                   
                              
                                    <div class="ms-2 me-auto">
                                    <div class="fw-bold"> {{sala.nombreSala}}</div>
                                    Mensaje de otro usuario
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                </li>
                               
                               
                            </ol>
                        </div>
                         <div class="col col-8">
                            <div class="bg-gray-100 w-100  text-center">
                                <h3 class="text-center mt-3">{{salaActual.nombreSala}}</h3>
                                <button type="button" class="btn btn-outline-danger btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Finaliza consulta
                                </button>

                            </div>
                            <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Terminar consulta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       ¿Seguro que desea terminar esta consulta?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger">Si, terminar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                             <contenedor-mensaje :mensajes="mensajes"/>
                            <input-mensaje 
                            :sala="salaActual"
                            v-on:mensajeEnviado="getMensajes()"/>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
      

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ContenedorMensaje from './contenedorMensaje.vue'
    import InputMensaje from './inputMensaje.vue'
import SalaChatSeleccion from './salaChatSeleccion.vue'

    export default {
        components: {
            AppLayout,
            ContenedorMensaje,
            InputMensaje,
                SalaChatSeleccion,
           
        },
        data: function(){
            return{
                salasChat:[],
                salaActual:[],
                mensajes:[],
                sala:{
                    
                }
            }
        },
        watch:{
            salaActual(val, oldVal){
                if(oldVal.id)
                {
                    this.desconectar(oldVal);
                }
                this.conectar();
            }
        },
        methods:{
            conectar(){
                if(this.salaActual.id){
                    let vm = this;
                    this.getMensajes();
                    window.Echo.private("chat."+this.salaActual.id).listen('.mensaje.nuevo',e=>{
                        vm.getMensajes();
                    });
                }
            },
            desconectar(sala){
                window.Echo.leave("chat."+sala.id);
            },
            getSalas(){
                axios.get('/chat/salas')
                .then( response=>{
                    this.salasChat = response.data;
                    this.setSala(response.data[0]);

                })
                .catch(error=>{
                    console.log(error);
                })
            },
            setSala(sala){
                this.salaActual = sala;    
              
            },
            getMensajes(){
                axios.get('/chat/salas/'+this.salaActual.id+'/mensajes')
                .then(response=>{
                    this.mensajes = response.data;
                })
                .catch(error=>{
                    console.log(error);
                })
            },
            async obtenerSala(){
                const res = await axios.get('/abrir/chat');
                if(res.data!=0){
                    this.setSala(res.data);
                }
                
            }
        },
        created(){
            this.getSalas();
            this.obtenerSala();
        }
    }
</script>
