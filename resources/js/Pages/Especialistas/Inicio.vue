<template>
    <app-layout title="Dashboard">
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
       
                <h3>Gestionar Especialistas</h3>    
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo-Modal" @click="modificar=false;abrirModal();">
                    Nuevo
                </button>

                    <!-- Modal -->
                <div class="modal fade" id="nuevo-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo especialista</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="my-4">
                                    <label for="nombre">Nombre Especialista</label>
                                    <input v-model="especialista.name" type="text" class="form-control" placeholder="Nombre Especialista" id="name">
                                    <span class="text-danger" v-if="errores.name">{{errores.name[0]}}</span>
                                </div>
                                <div class="my-4">
                                    <label for="descripcion">Correo Especialista</label>
                                    <input v-model="especialista.email" type="text" class="form-control" placeholder="Correo" id="email">
                                    <span class="text-danger" v-if="errores.email">{{errores.email[0]}}</span>
                                </div>
                                <div class="my-4">
                                    <label for="nombre">Contraseña</label>
                                    <input v-model="especialista.password" type="password" class="form-control" placeholder="Contra Especialista" id="password">
                                    <span class="text-danger" v-if="errores.password">{{errores.password[0]}}</span>
                                </div>
                                <div class="my-4">
                                    <label for="descripcion">Codigo Profesional</label>
                                    <input v-model="especialista.codigoProfesional" type="text" class="form-control" placeholder="Codigo Profesional" id="codigoProfesional">
                                    <span class="text-danger" v-if="errores.codigoProfesional">{{errores.codigoProfesional[0]}}</span>
                                </div>
                                  <div class="my-4">
                                    <label for="descripcion">Especialidad</label>
                                 
                                    <select v-model="especialista.especialidad" id="especialidad" class="form-select"   placeholder="Especialidad" aria-label="Default select example">
                                       
                                        <option  v-for="esp in especialidades.data" :key="esp.id" :value="esp.id">{{esp.nombre}}</option>
                                      
                                    </select>
                                    <span class="text-danger" v-if="errores.especialidad">{{errores.especialidad[0]}}</span>
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
                            {{especialistas.from}} - {{especialistas.to }} total: {{especialistas.total}}
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
                                <th scope="col">Nombre Especialista</th>
                                <th scope="col">Correo Especialista</th>   
                                <th scope="col">Especialidad</th>   
                                <th scope="col">Codigo Profesional</th>                            
                                <th scope="col" colspan="2" class="text-center">Acciones</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="especia in especialistas.data" :key="especia.id">
                                <th scope="row">{{especia.id}}</th>
                                <td>{{especia.usuario.name}}</td>
                                <td>{{especia.usuario.email}}</td>
                                <td>{{especia.especialidad.nombre}}</td>
                                <td>{{especia.reconocimiento}}</td>
                                <td>   
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" :data-bs-target="'#editarModal_'+especia.id" @click="modificar=true; abrirModal(especia);">
                                    Editar
                                    </button>
                                </td>                           
                                <td>                               
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+especia.id">
                                        Eliminar
                                    </button>
                                </td>
                                    <!-- Modal Editar-->
                                    <div class="modal fade" :id="'editarModal_'+especia.id"  tabindex="-1" :aria-labelledby="'editarModalLabel_'+especia.id" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Especialidad</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="my-4">
                                                    <label for="nombre">Nombre Especialista</label>
                                                    <input v-model="especialista.name" type="text" class="form-control" placeholder="Nombre Especialista" id="name">
                                                    <span class="text-danger" v-if="errores.name">{{errores.name[0]}}</span>
                                                </div>
                                                <div class="my-4">
                                                    <label for="descripcion">Correo Especialista</label>
                                                    <input v-model="especialista.email" type="text" class="form-control" placeholder="Correo" id="email">
                                                    <span class="text-danger" v-if="errores.email">{{errores.email[0]}}</span>
                                                </div>
                                               
                                                <div class="my-4">
                                                    <label for="descripcion">Codigo Profesional</label>
                                                    <input v-model="especialista.codigoProfesional" type="text" class="form-control" placeholder="Codigo Profesional" id="codigoProfesional">
                                                    <span class="text-danger" v-if="errores.codigoProfesional">{{errores.codigoProfesional[0]}}</span>
                                                </div>
                                                <div class="my-4">
                                                    <label for="descripcion">Especialidad</label>
                                                
                                                    <select v-model="especialista.especialidad" id="especialidad" class="form-select" aria-label="Default select example">
                                                        <option selected>Abre este menu</option>
                                                        <option  v-for="esp in especialidades.data" :key="esp.id" :value="esp.id">{{esp.nombre}}</option>
                                                    
                                                    </select>
                                                    <span class="text-danger" v-if="errores.especialidad">{{errores.especialidad[0]}}</span>
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
                                    <div class="modal fade" :id="'eliminarModal_'+especia.id"  tabindex="-1" :aria-labelledby="'eliminarModalLabel_'+especia.id" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" :id="'eliminarModalLabel_'+especia.id">Seguro que due desea eliminar este registro?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Seguro que desea eliminar el registro <b>{{especia.id}}</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" @click="eliminar(especia.id);" data-bs-dismiss="modal">Si, Eliminar</button>
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
                                    <li class="page-item" :class="{disabled:pagination.page==especialistas.last_page}" ><a class="page-link" @click="pagination.page++, listar();" href="#">&#62;</a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==especialistas.last_page}" ><a class="page-link" @click="pagination.page=especialistas.last_page, listar();" href="#" ><span >&raquo;</span></a></li>
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
                especialista:{
                    id:'0',
                    name:'',
                    email:'',
                    password:'',
                    especialidad:'',
                    codigoProfesional:'',
                },
                id:0,
                modificar:true,
                modal:0,
                especialistas:[],
                especialidades:[],
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
                const res2 = await axios.get('/especialidads/',{params:this.todo,});
                this.especialidades = res2.data;
                const res = await axios.get('/especialistas/',{params:this.pagination,});
                this.especialistas = res.data;
               
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
                if(fin>this.especialistas.last_page){
                    fin=this.especialistas.last_page;
                }
                for(let i=ini; i<=fin; i++){
                    arrayN.push(i);
                }
                this.paginas=arrayN;    
            },
            async eliminar(id){
                const res = await axios.delete('/especialistas/'+id);
                this.cerrarModal();
                this.listar();

            },
            async guardar(){
                try{

                    if(this.modificar){
                        const res = await axios.put('/especialistas/'+this.id,this.especialista);
                         console.log(res);         
                    }
                    else{
                        const res = await axios.post('/especialistas/',this.especialista);
                          console.log(res);
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
                    this.especialista.id = data.id;
                    this.especialista.name=data.usuario.name;
                    this.especialista.email=data.usuario.email;
                    this.especialista.especialidad=data.especialidad.id;
                    this.especialista.password='';
                    this.especialista.codigoProfesional=data.reconocimiento;
                 
                }
                else{
                    this.id=0;
                     this.especialista.id = '';
                    this.especialista.name='';
                    this.especialista.email='';
                    this.especialista.especialidad='';
                    this.especialista.password='';
                    this.especialista.codigoProfesional='';
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
