<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Solicitudes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="p-4">
                      <h3> Solicitudes de especialistas </h3>
                   <table class="table table-striped table-sm">
                      
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Fecha registro</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Nombre especialista 1</td>
                                <td>Especialidad 1</td>
                                <td>25/08/2021</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Ver Solicitud
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Nombre especialista 2</td>
                                <td>Especialidad 2</td>
                                <td>25/08/2021</td>
                                <td>
                                     <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Ver Solicitud
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Nombre especialistas 3</td>
                                <td>Especialidad 3</td>
                                <td>25/08/2021</td>
                                <td>
                                     <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Ver Solicitud
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ver Solicitud</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Nombre</b></h5>
                                    <h6>nombre especialista</h6>
                            
                                    <h5><b>Correo</b></h5>
                                    <h6>correo@gmail.com</h6>

                                    <h5><b>Especialidad</b></h5>
                                    <h6>nombre especialidad</h6>

                                    <h5><b>Codigo profesional</b></h5>
                                    <h6>codigo</h6>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Aceptar y crear cuenta</button>
                                    <button type="button" class="btn btn-danger">Rechazar</button>
                                </div>
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
            AppLayout,
            
           
        }
        
    }
</script>
