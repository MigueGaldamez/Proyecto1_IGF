<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Gestión de especialistas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="p-4">
                      <h3> Especialistas </h3>
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
                                    Editar
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm ms-2">Deshabilitar</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Nombre especialista 2</td>
                                <td>Especialidad 2</td>
                                <td>25/08/2021</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Editar
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm ms-2">Deshabilitar</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Nombre especialistas 3</td>
                                <td>Especialidad 3</td>
                                <td>25/08/2021</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Editar
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm ms-2">Deshabilitar</button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Información personal</b></h5>
                                    <div class="mb-3">
                                        <label for="nombre_especialista" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_especialista">
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo_especialista" class="form-label">Correo electronico</label>
                                        <input type="email" class="form-control" id="correo_especialista">
                                    </div>

                                    <h5><b>Actualizar contraseña</b></h5>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirm" class="form-label">Email address</label>
                                        <input type="text" class="form-control" id="password_confirm">
                                    </div>

                                    <h5><b>Actualizar especialidad</b></h5>
                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Seleccionar</option>
                                            <option value="1">Derecho Civil</option>
                                            <option value="2">Derecho Familiar</option>
                                            <option value="3">Derecho Mercantil</option>
                                            <option value="4">Derecho Laboral</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="codigo_profesional" class="form-label">Codigo profesional</label>
                                        <input type="text" class="form-control" id="codigo_profesional">
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
