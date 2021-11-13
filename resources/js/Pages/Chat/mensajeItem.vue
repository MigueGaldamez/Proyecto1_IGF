<template>
    <div v-if="mensaje.usuario.id == usuario" class="clearfix">
        <div class="message-data text-right">
            <span class="message-data-time">{{mensaje.created_at}}</span>
        </div>
      
        <div class="message other-message float-right">{{mensaje.mensaje}}.</div>
    </div>
    <div v-if="mensaje.usuario.id !=usuario" class="clearfix">
        <div class="message-data text-left">
            <span class="message-data-time">{{mensaje.usuario.name}}, {{mensaje.created_at}}</span>
        </div>
      
        <div class="message my-message float-left">{{mensaje.mensaje}}.</div>
    </div>
   
</template>

<script>

export default {
    props:['mensaje','usuario'],
    data(){ 
       
    },
    methods:{
        
    },
    created(){
      
    },
}
</script>
