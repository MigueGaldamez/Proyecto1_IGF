<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               <sala-chat-seleccion
               
               v-if="salaActual.id"
               :salas="salasChat"
               :salaActual="salaActual"
               v-on:salaChanged="setSala($event)"/>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <contenedor-mensaje :mensajes="mensajes"/>
                   <input-mensaje 
                   :sala="salaActual"
                   v-on:mensajeEnviado="getMensajes()"/>
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
            }
        },
        created(){
            this.getSalas();
        }
    }
</script>
