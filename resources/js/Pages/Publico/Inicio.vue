<template>
    <front-end title="Dashboard">     
         <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://image.freepik.com/free-photo/close-up-workers-with-briefcases_1098-3096.jpg" width="100%" height="100%"/>

                    <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Bienvenido al Sistema de consultas en linea.</h1>
                        <p>Un Proyecto traido a ustedes por IGF115 y PRN315.</p>
                        <p><a class="btn btn-lg btn-primary boton-principal" href="#">Inicia sesion Ahora</a></p>
                    </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://image.freepik.com/free-photo/court-hammer-books-judgment-law-concept_144627-30461.jpg" width="100%" height="100%"/>

                    <div class="container">
                    <div class="carousel-caption">
                        <h1>Grande expertos.</h1>
                        <p>Contamos con un catalogo de especialistas en todas las tamas legales.</p>
                        <p><a class="btn btn-lg btn-primary boton-principal" href="#">Mas informacion</a></p>
                    </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://image.freepik.com/free-photo/grey-marble-column-details-building_1359-886.jpg" width="100%" height="100%"/>
                    <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Nos importa tu opinion.</h1>
                        <p>Tienes alguna recomendacion para nuestro sistema, adelante.</p>
                        <p><a class="btn btn-lg btn-primary boton-principal" href="#">Contactanos</a></p>
                    </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
      
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div >
                    <div class="row">
                        <div class="col col-7">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-0">
                                <div class="bg-gray-700 pt-3 pb-2 px-4 w-100">
                                    <h3 class="text-light">Ejemplo de consultas solventadas</h3>
                                </div>   
                                <div class="p-4">
                                    <div class="nav nav-tabs tabs text-center">
                                        <input type="radio" class="active" id="radio-1" name="tabs" checked data-bs-toggle="tab" data-bs-target="#nav-uno" role="tab" aria-controls="nav-uno" aria-selected="true"/>
                                        <label class="tab" for="radio-1" >Nuevas<span class="notification">{{consultas.total}}</span></label>
                                        <input type="radio" name="tabs"  id="radio-2" data-bs-toggle="tab" data-bs-target="#nav-dos"  role="tab" aria-controls="nav-dos" aria-selected="false"/>
                                        <label class="tab" for="radio-2" >Mejor valoradas</label>
                                        <input type="radio" name="tabs" id="radio-3" data-bs-toggle="tab" data-bs-target="#nav-tres"  role="tab" aria-controls="nav-tres" aria-selected="false"/>
                                        <label class="tab" for="radio-3">De los mejores</label>
                                        <span class="glider"></span>
                                    </div>

                                
                                    <div class="tab-content mt-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active px-4" id="nav-uno" role="tabpanel" aria-labelledby="radio-1">
                                            <div class="row">
                                                <div v-for="consulta in consultas.data" :key="consulta.id" class="col col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{consulta.titulo}}</h5>
                                                            <p class="card-text text-muted fst-italic">{{consulta.consulta}}</p>
                                                            <small>Publicada el <b>{{consulta.created_At}}</b></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-dos" role="tabpanel" aria-labelledby="radio-2">
                                            <div class="row">
                                                <div v-for="consulta in consultas.data" :key="consulta.id" class="col col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{consulta.titulo}}</h5>
                                                            <p class="card-text text-muted fst-italic">{{consulta.consulta}}</p>
                                                            <small>Publicada el <b>{{consulta.created_At}}</b></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">¿Una asesoria legal  de las mejor valoradas?</h5>
                                                            <p class="card-text text-muted fst-italic">Algun texto de prueba que diga ver mas...</p>
                                                            <small>Publicada el <b>13 - diciembre 2021</b></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-tres" role="tabpanel" aria-labelledby="radio-3">
                                            <div class="row">
                                                <div v-for="consulta in consultas.data" :key="consulta.id" class="col col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{consulta.titulo}}</h5>
                                                            <p class="card-text text-muted fst-italic">{{consulta.consulta}}</p>
                                                            <small>Publicada el <b>{{consulta.created_At}}</b></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-5">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-0">
                          
                              <div class="colorBonito pt-3 pb-2 px-4 w-100">
                                    <h3 class="text-light">Mejores Especialistas</h3>
                                </div>   
                            <div class="row p-4">
                               
                                <div v-for="especia in especialistas.data" :key="especia.id" class="col col-12">
                                   <div class="card p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="image"> <img src="https://avatars.githubusercontent.com/u/25284452?v=4" class="rounded" width="155"> </div>
                                            <div class="ml-3 w-100">
                                                <h4 class="mb-0 mt-0">{{especia.usuario.name}}</h4> <span>{{especia.especialidad.nombre}}</span>
                                                <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats px-4">
                                                    <div class="d-flex flex-column"> <span class="articles">Preguntas</span> <span class="number1">{{especia.id}}</span> </div>
                                                    <div class="d-flex flex-column"> <span class="followers">Usuarios Contentos</span> <span class="number2">{{especia.usuario.id}}</span> </div>
  
                                                </div>
                                                <div class="button mt-2 d-flex flex-row align-items-center"> 
                                                    <button class="btn btn-sm btn-outline-primary w-100">Consultar</button> 
                                                    <button class="btn btn-sm btn-primary w-100 ml-2">ver detalles</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </front-end>
</template>

<script>
    import { defineComponent } from 'vue'
    import FrontEnd from '@/Layouts/FrontEnd.vue'

    export default defineComponent({
        components: {
            FrontEnd,
         
        },
         data(){
            return{
                 especialistas:[],
                 especialista:[],
                 consultas:[],
            }
        },
         methods:{
            async listar(){
              
                const res = await axios.get('/especialistas/',{params:this.pagination,});
                this.especialistas = res.data;

                const res2 = await axios.get('/consultas/');
                this.consultas = res2.data;
            },
        },
         created(){
            this.listar();
        }
    })
</script>
