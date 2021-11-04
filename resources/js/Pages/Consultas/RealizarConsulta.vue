<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Realizar consulta
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-4">
                        <h3> Nuestros especialistas </h3>
                        <!-- listado de especialistas -->
                        <div class="row">
                            <div v-for="especia in especialistas.data" :key="especia.id">
                                <div class="col-md-4">
                                <div class="card user-card">
                                
                                    <div class="card-block">
                                    
                                        <h4 class="f-w-600 mt-2 m-b-10">{{especia.usuario.name}}</h4>
                                        <p class="text-muted"><span class="badge bg-primary">Anti corrupción</span> | <span class="badge bg-warning text-dark">Derecho deportivo</span> | <span class="badge bg-info text-dark">Legislación médica</span></p>
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
                                        <p class="m-t-15 text-muted"><button class="btn boton-principal text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Realizar Consulta</button></p>
                                        <hr>
                                    
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </div>
                        <!-- fin especialistas -->

                        <!-- Modal de solicitud -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Realizar consulta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Especialista seleccionado</b></h5>
                                    <div class="mb-3">
                                        <!-- <label for="nombre_asesor" class="form-label">Especialista</label> -->
                                        <input type="text" class="form-control" id="nombre_asesor" value="Especialista1 Apellido1" disabled>
                                    </div>

                                    <br>
                                    <h5><b>Contenido de la consulta</b></h5>
                                    <div class="mb-3">
                                        <label for="titulo_consulta" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="titulo_consulta">
                                    </div>

                                    <div class="mb-3">
                                        <label for="consulta" class="form-label">Consulta</label>
                                        <textarea class="form-control" id="consulta"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Enviar consulta</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal -->
                
                   
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
            
            
           
        },data(){
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
