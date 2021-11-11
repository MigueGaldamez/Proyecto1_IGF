<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Pagos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="p-4">
                    <h3 v-if="usuario.especialista"> Pagos de consultas Recibidas </h3>
                    <h3 v-if="!usuario.especialista"> Pagos de consultas Realizadas </h3>
                 
                    <form class="mb-4 mt-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="anio" class="col-form-label">Filtro</label>
                        </div>
                        <div class="col-auto">
                            <select  v-model="anio" class="form-select" id="anio" aria-label="Default select example">
                                <option value="0" selected>Seleccionar año:</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select :disabled="anio == 0" v-model="mes" class="form-select" id="anio" aria-label="Default select example">
                                <option value="0" selected>Seleccionar mes:</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" @click="listar()">Buscar</button>
                        </div>
                    </div>
                    </form>
                    <div v-if="pagos.length==0" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                          
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>

                      
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                              No hay datos que cumplan ese criterio
                            </div>
                        </div>
                    </div>
                   <table class="table table-striped table-sm">
                      
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Consulta</th>
                                <th scope="col">Fecha</th>
                                <th v-if="usuario.especialista" scope="col">Cliente</th>
                                <th v-if="!usuario.especialista" scope="col">Especialista</th>
                                <th scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pago in pagos" :key="pago.id">
                                <th scope="row">{{pago.id}}</th>
                                <td>{{pago.consulta.titulo}}</td>
                                <td>{{pago.created_at}}</td>
                                <td v-if="usuario.especialista" >{{pago.cliente.name}}</td>
                                <td v-if="!usuario.especialista" >{{pago.especialista.name}}</td>
                                <td>$ {{pago.consulta.precio}}</td>
                                
                            </tr>
                           
                        </tbody>
                        </table>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 offset-md-9 text-end">
                                <b>Total <span v-if="usuario.especialista">Recibido </span><span v-if="!usuario.especialista">Aportado </span>$ {{suma}}</b>
                                </div>
                            </div>
                        </div>

                       
                        </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'



    export default {
        components: {
            AppLayout       
        },
        data(){ 
            return{
                mes:0,
                anio:0,
                suma:'',
                usuario:[],
                pagos:[],
            }
        },
        methods:{
            async listar(){
                
                const res = await axios.get('/obtener/usuario');
                this.usuario = res.data;
                this.suma='';
                const res2 = await axios.get('/pagos/ver?anio='+this.anio+'&mes='+this.mes);
                this.pagos = res2.data;              
                this.pagos.forEach(element => {
                    this.suma = this.suma + element.consulta.precio;
                });
                console.log(this.suma);
            },           
        },
        created(){
            this.listar();
        },
        
    }
</script>
