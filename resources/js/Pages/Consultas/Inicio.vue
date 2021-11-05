<template>
    <app-layout title="Dashboard">
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
       
                <h3>Gestionar consulta</h3>    
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo-Modal" @click="modificar=false;abrirModal();">
                    Nuevo
                </button>

                    <!-- Modal -->
                <div class="modal fade" id="nuevo-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nueva consulta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                 <div class="my-4">
                                    <label for="titulo">titulo Especialidad</label>
                                    <input v-model="consulta.titulo" type="text" class="form-control" placeholder="titulo Especialidad" id="titulo">
                                    <span class="text-danger" v-if="errores.titulo">{{errores.titulo[0]}}</span>
                                </div>
                                <div class="my-4">
                                    <label for="descripcion">Descripción Especialidad</label>
                                    <input v-model="consulta.consulta" type="text" class="form-control" placeholder="Descripcion" id="descripcion">
                                    <span class="text-danger" v-if="errores.descripcion">{{errores.descripcion[0]}}</span>
                                </div>
                                    <div class="my-4">
                                        <label for="descripcion">Especialidad</label>
                                    
                                        <select v-model="consulta.idEspecialista" id="especialidad" class="form-select" aria-label="Default select example">
                                            <option selected>Abre este menu</option>
                                            <option  v-for="esp in especialistas.data" :key="esp.id" :value="esp.id">{{esp.usuario.name}}</option>
                                        
                                        </select>
                                        <span class="text-danger" v-if="errores.idEspecialista">{{errores.idEspecialista[0]}}</span>
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
                            {{consultas.from}} - {{consultas.to }} total: {{consultas.total}}
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
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripcion</th> 
                                <th scpoe="col">Cliente que registro</th>                           
                               
                                <th scope="col">Acciones</th>                          
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="consul in consultas.data" :key="consul.id">
                                <th scope="row">{{consul.id}}</th>
                                <td>{{consul.titulo}}</td>
                                <td>{{consul.consulta}}</td>
                                <td>{{consul.cliente.name}}</td>
                                <td>   
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" :data-bs-target="'#editarModal_'+consul.id" @click="modificar=true; abrirModal(consul);">
                                    Editar
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+consul.id">
                                        Eliminar
                                    </button>
                                </td>
                                <!-- Modal Editar-->
                                <div class="modal fade" :id="'editarModal_'+consul.id"  tabindex="-1" :aria-labelledby="'editarModalLabel_'+consul.id" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Consulta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="my-4">
                                                <label for="titulo">titulo Especialidad</label>
                                                <input v-model="consulta.titulo" type="text" class="form-control" placeholder="titulo Especialidad" id="titulo">
                                                <span class="text-danger" v-if="errores.titulo">{{errores.titulo[0]}}</span>
                                            </div>
                                            <div class="my-4">
                                                <label for="descripcion">Descripción Especialidad</label>
                                                <input v-model="consulta.consulta" type="text" class="form-control" placeholder="Descripcion" id="descripcion">
                                                <span class="text-danger" v-if="errores.descripcion">{{errores.descripcion[0]}}</span>
                                            </div>
                                             <div class="my-4">
                                                    <label for="descripcion">Especialidad</label>
                                                
                                                    <select v-model="consulta.idEspecialista" id="especialidad" class="form-select" aria-label="Default select example">
                                                        <option selected>Abre este menu</option>
                                                        <option  v-for="esp in especialistas.data" :key="esp.id" :value="esp.id">{{esp.usuario.name}}</option>
                                                    
                                                    </select>
                                                    <span class="text-danger" v-if="errores.idEspecialista">{{errores.idEspecialista[0]}}</span>
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
                                <div class="modal fade" :id="'eliminarModal_'+consul.id"  tabindex="-1" :aria-labelledby="'eliminarModalLabel_'+consul.id" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'eliminarModalLabel_'+consul.id">Seguro que due desea eliminar este registro?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea eliminar el registro <b>{{consul.titulo}}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" @click="eliminar(consul.id);" data-bs-dismiss="modal">Si, Eliminar</button>
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
                                    <li class="page-item" :class="{disabled:pagination.page==consultas.last_page}" ><a class="page-link" @click="pagination.page++, listar();" href="#">&#62;</a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==consultas.last_page}" ><a class="page-link" @click="pagination.page=consultas.last_page, listar();" href="#" ><span >&raquo;</span></a></li>
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
                consulta:{
                    idEspecialista:'',
                    titulo:'',
                    consulta:'',
                  
                },
                id:0,
                modificar:true,
                modal:0,
                especialistas:[],
                consultas:[],
                tituloModal:'',
                errores:{},
                pagination:{
                    page:1,
                    per_page:5,

                },
                 todo:{
                    page:1,
                    per_page:50,
                },
                paginas:[],
            }
        },
        methods:{
            async listar(){
                const res = await axios.get('/consultas/',{params:this.pagination,});
                this.consultas = res.data;

                const res2 = await axios.get('/especialistas/',{params:this.todo,});
                this.especialistas = res2.data;
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
                if(fin>this.consultas.last_page){
                    fin=this.consultas.last_page;
                }
                for(let i=ini; i<=fin; i++){
                    arrayN.push(i);
                }
                this.paginas=arrayN;    
                 
            },
            async eliminar(id){
                const res = await axios.delete('/consultas/'+id);
                this.cerrarModal();
                this.listar();

            },
            async guardar(){
                try{
                    
                    if(this.modificar){
                        const res = await axios.put('/consultas/'+this.id,this.consulta);         
                    }
                    else{
                        console.log(this.consulta);
                        const res = await axios.post('/consultas/',this.consulta);
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
                    this.consulta.titulo=data.titulo;
                    this.consulta.consulta=data.consulta;
                    this.consulta.idEspecialista = data.idEspecialista;
                 
                }
                else{
                    this.id=0;
                    this.consulta.titulo='';
                    this.consulta.consulta='';
                    this.consulta.idEspecialista ='';
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