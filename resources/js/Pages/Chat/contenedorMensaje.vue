<template>
    <div class="h-95 w-full">
        <div class="h-full p-2 flex-col-reverse overflow-scroll chat-history">
            <div v-for="(mensaje, index) in mensajes" :key="index">
                <mensaje-item :mensaje="mensaje"/>
            </div>
        </div>
    </div>
</template>

<script>
import MensajeItem from "./mensajeItem.vue";


export default {
    components: { MensajeItem },
    props:['mensajes'],
   
}
</script>
