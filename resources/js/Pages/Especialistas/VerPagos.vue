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
                    <h3> Pagos de consultas realizadas </h3>
                    <form class="mb-4 mt-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="anio" class="col-form-label">Filtro</label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" id="anio" aria-label="Default select example">
                                <option selected>Seleccionar año:</option>
                                <option value="1">2019</option>
                                <option value="2">2020</option>
                                <option value="3">2021</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" id="anio" aria-label="Default select example">
                                <option selected>Seleccionar mes:</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                    </form>
                   <table class="table table-striped table-sm">
                      
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Consulta</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Titulo consulta 1</td>
                                <td>25/08/2021</td>
                                <td>$20</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Titulo consulta 2</td>
                                <td>25/08/2021</td>
                                <td>$20</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Titulo consulta 3</td>
                                <td>25/08/2021</td>
                                <td>$20</td>
                            </tr>
                        </tbody>
                        </table>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 offset-md-9 text-end">
                                <b>Total: $60</b>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ver consulta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Titulo</b></h5>
                                    <h6>Titulo</h6>
                            
                                    <h5><b>Especialista</b></h5>
                                    <h6>Nombre especialista</h6>

                                    <h5><b>Tipo</b></h5>
                                    <h6>Tipo consulta</h6>

                                    <h5><b>Fecha realización</b></h5>
                                    <h6>25/08/2021</h6>

                                    <h5><b>Consulta</b></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
