<template>
    <div v-if="mensaje.usuario.id == usuario.idUsuario" class="clearfix">
        <div class="message-data text-right">
            <span class="message-data-time">{{mensaje.created_at}}</span>
        </div>
      
        <div class="message other-message float-right">{{mensaje.mensaje}}.</div>
    </div>
    <div v-if="mensaje.usuario.id !=usuario.idUsuario" class="clearfix">
        <div class="message-data text-left">
            <span class="message-data-time">{{mensaje.usuario.name}}, {{mensaje.created_at}}</span>
        </div>
      
        <div class="message my-message float-left">{{mensaje.mensaje}}.</div>
    </div>
   
</template>

<script>

export default {
    props:['mensaje'],
    data(){ 
        return{
            usuario:{
                idUsuario:''
            }
        }
    },
    methods:{
        async listar(){
            const res = await axios.get('/obtener/usuario');
            this.usuario.idUsuario = res.data.id;
        },
    },
    created(){
        this.listar();
    },
}
</script>
