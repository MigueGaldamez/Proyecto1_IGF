<template>
    <app-layout title="Dashboard">
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
       
                <h3>Gestionar Especialidades</h3>    
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo-Modal" @click="modificar=false;abrirModal();">
                    Nuevo
                </button>

                    <!-- Modal -->
                <div class="modal fade" id="nuevo-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nueva especialidad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="my-4">
                                    <label for="nombre">Nombre Especialidad</label>
                                    <input v-model="especialidad.nombre" type="text" class="form-control" placeholder="Nombre Especialidad" id="nombre">
                                    <span class="text-danger" v-if="errores.nombre">{{errores.nombre[0]}}</span>
                                </div>
                                <div class="my-4">
                                    <label for="descripcion">Descripción Especialidad</label>
                                    <input v-model="especialidad.descripcion" type="text" class="form-control" placeholder="Descripcion" id="descripcion">
                                    <span class="text-danger" v-if="errores.descripcion">{{errores.descripcion[0]}}</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button"  @click="guardar();" class="btn btn-primary"  data-bs-dismiss="modal">Guardar Cambios</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--FinModal-->
                    <hr/>
                    <div class="row">
                        <div class="col-3 md-3">
                            {{especialidades.from}} - {{especialidades.to }} total: {{especialidades.total}}
                        </div>
                        <div class="col-3 md-3">                        
                            <select class=" form-control form-select form-select-sm" v-model="pagination.per_page" @change="listar();">
                            <option selected>Elementos por pagina</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <table class="table table-striped table-sm table-hover">
                        <thead class="table-dark"> 
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre Especialidad</th>
                                <th scope="col">Descripcion</th>                            
                                <th scope="col" colspan="2" class="text-center">Acciones</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="esp in especialidades.data" :key="esp.id">
                                <th scope="row">{{esp.id}}</th>
                                <td>{{esp.nombre}}</td>
                                <td>{{esp.descripcion}}</td>
                                <td>   
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" :data-bs-target="'#editarModal_'+esp.id" @click="modificar=true; abrirModal(esp);">
                                    Editar
                                    </button>
                                </td>                           
                                <td>                               
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+esp.id">
                                        Eliminar
                                    </button>
                                </td>
                                <!-- Modal Editar-->
                                <div class="modal fade" :id="'editarModal_'+esp.id"  tabindex="-1" :aria-labelledby="'editarModalLabel_'+esp.id" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Especialidad</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="my-4">
                                                <label for="nombre">Nombre Especialidad</label>
                                                <input v-model="especialidad.nombre" type="text" class="form-control" placeholder="Nombre Especialidad" id="nombre">
                                                <span class="text-danger" v-if="errores.nombre">{{errores.nombre[0]}}</span>
                                            </div>
                                            <div class="my-4">
                                                <label for="descripcion">Descripción Especialidad</label>
                                                <input v-model="especialidad.descripcion" type="text" class="form-control" placeholder="Descripcion" id="descripcion">
                                                <span class="text-danger" v-if="errores.descripcion">{{errores.descripcion[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button"  @click="guardar();" class="btn btn-primary"  data-bs-dismiss="modal">Guardar Cambios</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Fin Modal editar-->
                                <!-- Modal -->
                                <div class="modal fade" :id="'eliminarModal_'+esp.id"  tabindex="-1" :aria-labelledby="'eliminarModalLabel_'+esp.id" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'eliminarModalLabel_'+esp.id">Seguro que due desea eliminar este registro?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea eliminar el registro <b>{{esp.nombre}}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" @click="eliminar(esp.id);" data-bs-dismiss="modal">Si, Eliminar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Fin Modal eliminar-->
                            </tr>
                            
                        
                        </tbody>
                    </table>
                    <div class="row">
                        
                        <div class="col-6 md-6 text-center">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" :class="{disabled:pagination.page==1}" ><a class="page-link" @click="pagination.page=1, listar();" href="#"><span>&laquo;</span></a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==1}" ><a class="page-link" @click="pagination.page--, listar();" href="#">&#60;</a></li>
                                    <li class="page-item" v-for="n in paginas" :key="n" :class="{active:pagination.page==n}"><a class="page-link" @click="pagination.page=n, listar();" href="#">{{n}}</a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==especialidades.last_page}" ><a class="page-link" @click="pagination.page++, listar();" href="#">&#62;</a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==especialidades.last_page}" ><a class="page-link" @click="pagination.page=especialidades.last_page, listar();" href="#" ><span >&raquo;</span></a></li>
                                </ul>
                            </nav>
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
           
           
        },
        data(){
            return{
                especialidad:{
                    nombre:'',
                    descripcion:'',
                  
                },
                id:0,
                modificar:true,
                modal:0,
                especialidades:[],
                tituloModal:'',
                errores:{},
                pagination:{
                    page:1,
                    per_page:5,

                },
                paginas:[],
            }
        },
        methods:{
            async listar(){
                const res = await axios.get('/especialidads/',{params:this.pagination,});
                this.especialidades = res.data;
                this.listarPaginas();

            },
            listarPaginas(){
                const n = 2;
                let arrayN=[];
                let ini = this.pagination.page - 2;
                if(ini<1){
                    ini=1;
                }
                let fin = this.pagination.page + 2;
                if(fin>this.especialidades.last_page){
                    fin=this.especialidades.last_page;
                }
                for(let i=ini; i<=fin; i++){
                    arrayN.push(i);
                }
                this.paginas=arrayN;    
            },
            async eliminar(id){
                const res = await axios.delete('/especialidads/'+id);
                this.cerrarModal();
                this.listar();

            },
            async guardar(){
                try{

                    if(this.modificar){
                        const res = await axios.put('/especialidads/'+this.id,this.especialidad);         
                    }
                    else{
                        const res = await axios.post('/especialidads/',this.especialidad);
                    }  
                    this.cerrarModal();
                    this.listar();      

                }catch(error){
                    if(error.response.data){
                        this.errores = error.response.data.errors;
                    }
                }

            },
            abrirModal(data={}){
                
                if(this.modificar){
                    this.id=data.id;
                    this.especialidad.nombre=data.nombre;
                    this.especialidad.descripcion=data.descripcion;
                   
                 
                }
                else{
                    this.id=0;
                    this.especialidad.nombre='';
                    this.especialidad.descripcion='';
                }
            },
            cerrarModal(){
                this.modal=0;
                this.errores={};
            },
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.listar();
        }
    }
</script>
