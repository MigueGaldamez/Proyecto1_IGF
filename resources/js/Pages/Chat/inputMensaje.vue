<template>
    <div class="realtive h-10 m-1">
        <div style="border-top:1px solid #e6e6e6;" class="grid grid-cols-6">
            <input type="text" v-model="mensaje" @keyup.enter="enviarMensaje()" placeholder="Escribe algo" class="col-span-5 outline-none p-1"/>
            <button 
                @click="enviarMensaje()" 
                calss="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">
                Enviar
            </button>
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
