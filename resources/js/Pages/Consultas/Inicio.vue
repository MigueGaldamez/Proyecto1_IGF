<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Consultas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="p-4">
                      <h3> Consultas recibidas</h3>
                   <table class="table table-striped table-sm">
                      
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Consulta</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Titulo consulta 1</td>
                                <td>Usuario 45</td>
                                <td>¿Como proceder con tal situación?</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Aceptar Consulta y Asignar Precio
                                    </button>
                                      <button type="button" class="btn btn-danger btn-sm ms-2">Rechazar Consulta</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Titulo consulta 2</td>
                                <td>Usuario 45</td>
                                <td>¿Como proceder con tal situación?</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Aceptar Consulta y Asignar Precio
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm ms-2">Rechazar Consulta</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Titulo consulta 3</td>
                                <td>Usuario 45</td>
                                <td>¿Como proceder con tal situación?</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Aceptar Consulta y Asignar Precio
                                    </button>
                                      <button type="button" class="btn btn-danger btn-sm ms-2">Rechazar Consulta</button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Aceptar consulta y Asignar Precio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Usted esta a punto de aceptar la consulta con los siguientes detalles:<br>
                                    <b>Titulo Consulta: </b> Titulo 1 <br>
                                    <b>Usuario Consulta </b> Usuario45 <br>

                                    <h3 class="mt-4"><span class="">Asignar precio</span></h3>
                                    <div class="mb-3">
                                        
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">a este precio se le sumara un 20% dirigido a la empresa.</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
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
