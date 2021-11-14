<template>
    <div class="realtive h-20 mx-2 my-2" style="border-top:1px solid #e6e6e6;">
        <div v-if="sala!=null && sala.consulta.estado!=7"  class="grid grid-cols-6">
            <input type="text" v-model="mensaje" @keyup.enter="enviarMensaje()" placeholder="Escribe algo" class="col-span-5 outline-none p-1"/>
            <button 
                @click="enviarMensaje()" 
                class="place-self-end bg-blue-500 hover:bg-blue-700 p-1 mt-1 me-2 rounded text-white">
                Enviar Mensaje
            </button>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>




        <div v-if="sala!=null &&  sala.consulta.estado==7">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    Esta consulta ya finalizo, ahora solo puede consultar el historial de mensajes.
                </div>
            </div>
        </div>
          
    </div>
</template>

<script>
import Input from '../../Jetstream/Input.vue'
export default {
    components:{Input},
    props:['sala'],
    data:function(){
        return{
            mensaje:'' 
        }
    },
    methods:{
        enviarMensaje(){
            if(this.mensaje==''){
                return;
            }
                axios.post('/chat/salas/'+ this.sala.id+'/mensaje',{
                mensaje:this.mensaje
            })
            .then(response=>{
                if( response.status == 201){
                    console.log('si');
                    this.mensaje='';
                    this.$emit('mensajeEnviado');
                }
            })
            .catch(error=>{
                console.log(error);
            })
        }
       
    } 
}
</script>
