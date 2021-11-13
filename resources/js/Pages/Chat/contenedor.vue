<template>
    <app-layout title="Dashboard">
        <!--<template #header class="sticky position-sticky sticky-top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               sala-chat-seleccion
               
               v-if="salaActual.id"
               :salas="salasChat"
               :salaActual="salaActual"
               v-on:salaChanged="setSala($event)"/>
               <div class="grid grid-cols-2">
                    <div class="font-bold text-xl">
                          {{salaActual.nombreSala}} Chat
                    </div>
                    <div>
                        
                    </div>

                </div>
            </h2>
        </template>-->

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg chat" >
                    <div class="row">
                        <div class="col col-4 border-2 p-4">
                           
                            Otras conversaciones
                            <ol class="list-group mx-auto">
                                  <li class="list-group-item d-flex justify-content-between align-items-start" v-for="sala in salasChat" :key="sala.id" @click="setSala(sala);">
                                   
                              
                                    <div class="ms-2 me-auto">
                                    <div class="fw-bold"> {{sala.nombreSala}}</div>
                                
                                        <div v-for="(mensaje,index) in sala.ultimo_mensaje" :key="mensaje.id">
                                           
                                            <span v-if="index==sala.ultimo_mensaje.length-1">
                                                <span v-if="usuario.idUsuario==mensaje.idUsuario">Tú: </span>
                                                {{mensaje.mensaje}}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{sala.ultimo_mensaje.length}}</span>
                                </li>
                               
                               
                            </ol>
                        </div>
                         <div class="col col-8 px-0">
                            <div class="chat-header colorHeader text-center">
                                <h3 class="text-center">{{salaActual.nombreSala}}</h3>
                                <small v-if="salaActual.consulta.estado==5">Cliente solicitó finalizar la consulta</small>
                                <small v-if="salaActual.consulta.estado==6">Especialista solicitó finalizar la consulta</small><br>
                                <button v-if="salaActual.consulta.estado!=7"  type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                        <button type="button" class="btn btn-danger" @click="terminarConver(salaActual.consulta.id);" data-bs-dismiss="modal">Si, terminar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                             <contenedor-mensaje :mensajes="mensajes" :usuario="usuario.idUsuario"/>
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
                    
                }, 
                usuario:{
                    idUsuario:''
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
            listar(){
                axios.get('/obtener/usuario').then(res => {
                    this.usuario.idUsuario = res.data.id;
                    console.log(this.usuario.idUsuario)
                });  
            },
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
                console.log(this.salaActual.ultimo_mensaje[this.salaActual.ultimo_mensaje.length-1].id);
            },
            async obtenerSala(){
                const res = await axios.get('/abrir/chat');
                if(res.data!=0){
                    this.setSala(res.data);
                }
                
            },
              
            async terminarConver(idConsulta){
                const res = await axios.post('/terminar/consulta?idSala='+idConsulta);      
                this.getSalas();
                this.obtenerSala();  
                this.listar();  
                
            },
        },
        created(){
            this.getSalas();
            this.obtenerSala();
            this.listar();
        }
    }
</script>
