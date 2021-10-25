<template>
    <div class="clearfix">
        <div class="message-data text-right">
            <span class="message-data-time">{{mensaje.created_at}}</span>
        </div>
      
        <div class="message other-message float-right">{{mensaje.mensaje}}.</div>
    </div>
   
</template>

<script>

export default {
    props:['mensaje']
}
</script>
