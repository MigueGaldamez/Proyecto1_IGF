<template>
    <div>
        <b>{{mensaje.usuario.name}}: </b> {{mensaje.mensaje}}
    </div>
</template>

<script>

export default {
    props:['mensaje']
}
</script>
