<template>
    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">
            {{seleccionado.nombreSala}} Chat
        </div>
        <div>
            <select v-model="seleccionado" 
            @change="$emit('salaChanged', seleccionado)"
            class="float-right">
            <option v-for="(sala, index) in salas" :key="index" :value="sala">
                {{sala.nombreSala}}
            </option>
                
            </select>
        </div>

    </div>
</template>

<script>

export default {
    props:['salas','salaActual'],
    data: function(){
        return{
            seleccionado:''
        }
    },
    created(){
        this.seleccionado =this.salaActual;
    }
}
</script>
