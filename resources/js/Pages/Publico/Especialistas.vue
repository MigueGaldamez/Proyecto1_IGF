<template>
    <front-end title="Dashboard">     
         <!---->
        
        <div class="p-5 mb-4 rounded-3 bg-gray-200">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">Informacion del Sistema</h1>
                <p class="col-md-9 fs-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <button class="btn btn-secondary btn-lg boton-principal" type="button">Registrarse</button>
            </div>
        </div>

            



        <div class="pt-3 pb-2 px-4 bg-gray-700 mt-2 mb-4">
            <h2 class="text-white">Nuestros especialistas</h2>
        </div>
        <div class="container">
            
            <!----->
             <div class="row">
                            <div v-for="especia in especialistas.data" :key="especia.id" class="col col-md-4 col-xl-4">
                               
                                <div class="card user-card">
                                
                                    <div class="card-block">
                                    
                                        <h4 class="f-w-600 mt-2 m-b-10">{{especia.usuario.name}}</h4>
                                        <p class="text-muted"><span class="badge bg-primary">{{especia.especialidad.nombre}}</span></p>
                                        <hr>
                                        <p class="x m-t-15 mb-0">Nivel de actividad 60%</p>
                                        <ul class="list-unstyled activity-leval mt-0">
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <div class="colorBonito counter-block m-t-10 pt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                
                                                    <p><b class="text-dark">Respuestas</b> <br> 189</p>
                                                </div>
                                            
                                                <div class="col-6">
                                                
                                                    <p><b class="text-dark">Consultas</b> <br> 189</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="m-t-15 text-muted"><button class="btn boton-principal text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModal(especia);">Realizar Consulta</button></p>
                                        <hr>
                                    
                                    </div>
                                </div>
                            </div>
                            
                        
                        </div>
            <!---->
            

          

        </div>

        <!---->
      
    </front-end>
</template>

<script>
    import { defineComponent } from 'vue'
    import FrontEnd from '@/Layouts/FrontEnd.vue'

    export default {
        components: {
            FrontEnd,
            
        },
        data(){
            return{
                 especialistas:[],
                 especialista:[],
            }
        },
         methods:{
            async listar(){
              
                const res = await axios.get('/especialistas/',{params:this.pagination,});
                this.especialistas = res.data;
            },
        },
         created(){
            this.listar();
        }
        
    }
</script>
