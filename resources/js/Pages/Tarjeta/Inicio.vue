<template>
    <app-layout title="Dashboard">
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
       
                <h3>Gestionar Tarjetas</h3>    
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#nuevo-Modal" @click="modificar=true;abrirModal();">
                   Agregar Tarjeta de Credito
                </button>
                &nbsp;
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo-Modal" @click="modificar=false;abrirModal();">
                  Agregar Tarjeta de Debito
                </button>

                    <!-- Modal -->
                    <div class="modal fade" id="nuevo-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva Tarjeta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="my-4">
                                        <label for="codigo">Codigo Tarjeta</label>
                                        <input v-model="tarjeta.codigo" type="text" class="form-control" placeholder="Codigo Tarjeta" id="codigo">
                                        <span class="text-danger" v-if="errores.codigo">{{errores.codigo[0]}}</span>
                                    </div>
                                    <div class="my-4">
                                        <label for="pin">Pin Tarjeta</label>
                                        <input v-model="tarjeta.pin" type="text" class="form-control" placeholder="Pin Tarjeta" id="pin">
                                        <span class="text-danger" v-if="errores.pin">{{errores.pin[0]}}</span>
                                    </div>
                                    <div class="my-4">
                                        <label for="banco">Banco</label>
                                        <input v-model="tarjeta.banco" type="text" class="form-control" placeholder="Banco" id="banco">
                                        <span class="text-danger" v-if="errores.banco">{{errores.banco[0]}}</span>
                                    </div>
                                     <div class="my-4">
                                        <label for="fechaVencimiento" >Tipo Tarjeta</label>
                                        <select class="form-select" disabled name="tipo" id="tipo" aria-label="Default select example"  v-model="tarjeta.tipo">
                                            <option selected>Seleccionar tipo</option>
                                            <option value="1">Credito</option>
                                            <option value="2">Debito</option>
                                      
                                        </select>
                                        <span class="text-danger" v-if="errores.tipo">{{errores.tipo[0]}}</span>
                                    </div>
                                    <div class="my-4">
                                        <label for="fechaVencimiento">Fecha Vencimiento</label>
                                        <input v-model="tarjeta.fechaVencimiento" type="date" class="form-control" placeholder="Fecha Vencimiento" id="fechaVencimiento">
                                        <span class="text-danger" v-if="errores.fechaVencimiento">{{errores.fechaVencimiento[0]}}</span>
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
                            {{tarjetas.from}} - {{tarjetas.to }} total: {{tarjetas.total}}
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
                                <th scope="col">Codigo</th>
                                <th scope="col">Fecha Vencimiento</th>           
                                <th scope="col">Banco</th>   
                                <th scope="col">Tipo</th>                         
                                <th scope="col" class="text-center">Acciones</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tar in tarjetas.data" :key="tar.id">
                                <th scope="row">{{tar.id}}</th>
                                 <td>Pertenece a: <br> <b>{{tar.usuario.name}}</b> </td>
                                <td> Numero Tarjeta: <br>{{tar.codigo}}</td>
                                <td>Vence: <br>{{tar.fechaVencimiento}}</td>
                               
                                    
                               
                                
                                <td v-if="tar.tipo == 1">Tipo: <br> Credito</td>
                                <td v-if="tar.tipo == 2">Tipo: <br> Debito</td>
                              
                                <td class="text-center">                               
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="'#eliminarModal_'+tar.id">
                                        Eliminar
                                    </button>
                                </td>
                                
                                <!-- Modal -->
                                <div class="modal fade" :id="'eliminarModal_'+tar.id"  tabindex="-1" :aria-labelledby="'eliminarModalLabel_'+tar.id" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'eliminarModalLabel_'+tar.id">Seguro que due desea eliminar este registro?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea eliminar el registro <b>{{tar.codigo}}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" @click="eliminar(tar.id);" data-bs-dismiss="modal">Si, Eliminar</button>
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
                                    <li class="page-item" :class="{disabled:pagination.page==tarjetas.last_page}" ><a class="page-link" @click="pagination.page++, listar();" href="#">&#62;</a></li>
                                    <li class="page-item" :class="{disabled:pagination.page==tarjetas.last_page}" ><a class="page-link" @click="pagination.page=tarjetas.last_page, listar();" href="#" ><span >&raquo;</span></a></li>
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
                tarjeta:{
                    codigo:'',
                    pin:'',
                    banco:'',
                    fechaVencimiento:'',
                    tipo:'',
                  
                },
                id:0,
                modificar:true,
                modal:0,
                tarjetas:[],
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
                const res = await axios.get('/tarjetas/',{params:this.pagination,});
                this.tarjetas = res.data;
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
                if(fin>this.tarjetas.last_page){
                    fin=this.tarjetas.last_page;
                }
                for(let i=ini; i<=fin; i++){
                    arrayN.push(i);
                }
                this.paginas=arrayN;    
            },
            async eliminar(id){
                const res = await axios.delete('/tarjetas/'+id);
                this.cerrarModal();
                this.listar();

            },
            async guardar(){
                try{

                    if(this.modificar){
                        const res = await axios.post('/tarjetas/',this.tarjeta);
                    }
                    else{
                        const res = await axios.post('/tarjetas/',this.tarjeta);
                    }  
                    this.cerrarModal();
                    this.listar();      

                }catch(error){
                    if(error.response.data){
                        this.errores = error.response.data.errors;
                    }
                }

            },
            abrirModal(){
                
                if(this.modificar){
                   
                    this.tarjeta.codigo='';
                    this.tarjeta.pin='';
                    this.tarjeta.banco='';
                    this.tarjeta.fechaVencimiento='';
                    this.tarjeta.tipo=1;
                   
                 
                }
                else{
                    
                    this.tarjeta.codigo='';
                    this.tarjeta.pin='';
                    this.tarjeta.banco='';
                    this.tarjeta.fechaVencimiento='';
                    this.tarjeta.tipo=2;
        
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
