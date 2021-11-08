<template>
    <app-layout title="Dashboard">
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
       
                <h3>Gestionar Clientes</h3>    
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo-Modal" @click="modificar=false;abrirModal();">
                    Nuevo
                </button>

                    <!-- Modal -->
                <div class="modal fade" id="nuevo-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="my-4">
                                    <label for="nombre">Nombre Cliente</label>
                                    <input v-model="cliente.name" type="text" class="form-control" placeholder="Nombre Cliente" id="name">
                                    <span class="text-danger" v-if="errores.name">{{errores.name[0]}}</span>
                                </div>
                                <div class="my-4">
                                    <label for="email">Correo</label>
                                    <input v-model="cliente.email" type="text" class="form-control" placeholder="Correo" id="email">
                                    <span class="text-danger" v-if="errores.email">{{errores.email[0]}}</span>
                                </div>
                                 <div class="my-4">
                                    <label for="password">Contraseña</label>
                                    <input v-model="cliente.password" type="password" class="form-control" placeholder="Contraseña" id="password">
                                    <span class="text-danger" v-if="errores.password">{{errores.password[0]}}</span>
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
                            {{clientes.from}} - {{clientes.to }} total: {{clientes.total}}
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
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">Correo</th>              
                                  <th scope="col">Fecha registro</th>              
                                <th scope="col" colspan="2" class="text-center">Acciones</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cliente in clientes.data" :key="cliente.id">
                                <th scope="row">{{cliente.id}}</th>
                                <td>{{cliente.name}}</td>
                                <td>{{cliente.email}}</td>
                                 <td>{{cliente.created_at}}</td>
                                <td>   
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" :data-bs-target="'#editarModal_'+cliente.id" @click="modificar=true; abrirModal(cliente);">
                                    Editar
                                    </button>
                                </td>                           
                                <td>                               
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+cliente.id">
                                        Eliminar
                                    </button>
                                </td>
                                <!-- Modal Editar-->
                                <div class="modal fade" :id="'editarModal_'+cliente.id"  tabindex="-1" :aria-labelledby="'editarModalLabel_'+cliente.id" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'editarModalLabel_'+cliente.id">Editar cliente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                         <div class="modal-body">
                                            <div class="my-4">
                                                <label for="nombre">Nombre Cliente</label>
                                                <input v-model="cliente.name" type="text" class="form-control" placeholder="Nombre Cliente" id="name">
                                                <span class="text-danger" v-if="errores.name">{{errores.name[0]}}</span>
                                            </div>
                                            <div class="my-4">
                                                <label for="email">Correo</label>
                                                <input v-model="cliente.email" type="text" class="form-control" placeholder="Correo" id="email">
                                                <span class="text-danger" v-if="errores.email">{{errores.email[0]}}</span>
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
                                <div class="modal fade" :id="'eliminarModal_'+cliente.id"  tabindex="-1" :aria-labelledby="'eliminarModalLabel_'+cliente.id" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'eliminarModalLabel_'+cliente.id">Seguro que due desea eliminar este registro?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea eliminar el registro <b>{{cliente.name}}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" @click="eliminar(cliente.id);" data-bs-dismiss="modal">Si, Eliminar</button>
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
                                    <li class="page-item" :class="{disabled:pagination.page==clientes.last_page}" ><a class="page-link" @click="pagination.page++, listar();" href="#">&#62;</a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==clientes.last_page}" ><a class="page-link" @click="pagination.page=clientes.last_page, listar();" href="#" ><span >&raquo;</span></a></li>
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
                cliente:{
                    name:'',
                    email:'',
                    password:'',
                    idTipoUsuario:1,
                  
                },
                id:0,
                modificar:true,
                modal:0,
                clientes:[],
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
                const res = await axios.get('/clientes/',{params:this.pagination,});
                this.clientes = res.data;
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
                if(fin>this.clientes.last_page){
                    fin=this.clientes.last_page;
                }
                for(let i=ini; i<=fin; i++){
                    arrayN.push(i);
                }
                this.paginas=arrayN;    
            },
            async eliminar(id){
                const res = await axios.delete('/clientes/'+id);
                this.cerrarModal();
                this.listar();

            },
            async guardar(){
                try{

                    if(this.modificar){
                        const res = await axios.put('/clientes/'+this.id,this.cliente);         
                    }
                    else{
                        const res = await axios.post('/clientes/',this.cliente);
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
                    this.cliente.name=data.name;
                    this.cliente.email=data.email;
                    this.cliente.idTipoUsuario = 1; 
                   
                 
                }
                else{
                    this.id=0;
                    this.cliente.name='';
                    this.cliente.email='';
                    this.cliente.password ='';
                    this.cliente.idTipoUsuario = 1; 
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
