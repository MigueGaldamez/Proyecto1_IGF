<template>
    <front-end title="Dashboard">     
        <div class="py-8">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    
                   
                   <div class="row justify-content-center">
                    
                       
                            <div class="row no-gutters">
                            <!--aUI-->
                                <div class="col-md-6 d-flex align-items-stretch izquierdo">
                                    <div class="contact-wrap w-100 p-md-5 p-4 py-5">
                                        <h3 class="mb-4 text-light">Registrarse <br> <b>Como usuario</b></h3> 
                                        <form @submit.prevent="submit">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Nombre:</h6>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" v-model="form.name" required autofocus autocomplete="name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Correo:</h6>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"  v-model="form.email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                         <h6 class="text-light">Contraseña:</h6>
                                                        <input type="password" class="form-control" name="subject" id="password" placeholder="Contraseña" v-model="form.password" required autocomplete="new-password">
                                                    </div>
                                                </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                         <h6 class="text-light">Confirmar Contraseña:</h6>
                                                        <input id="password_confirmation" type="password" class="form-control" name="subject"  placeholder="Confirmar Contraseña" v-model="form.password_confirmation" required autocomplete="new-password" >
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group">
                                                        <button class="btn btn-warning text-white" type="submit">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--aUI-->
                                <div class="col-md-6 d-flex align-items-stretch derecho">
                                    <div class="contact-wrap w-100 p-md-5 p-4 py-5">
                                         <h2 class=" text-light">Registrarse <br> <b>Especialista</b></h2> 
                                        <span class="mb-4 text-light">Sabes de leyes y te gustaria responder consultas</span>
                                        <div id="contactForm" name="contactForm" class="contactForm">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="text-light">Nombre:</h6>
                                                        <input v-model="especialista.name" type="text" class="form-control" name="name2" id="name2" placeholder="Nombre">                   
                                                        <span class="text-danger" v-if="errores.name">{{errores.name[0]}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="text-light">Correo:</h6>
                                                        <input v-model="especialista.email" type="email" class="form-control" name="email2" id="email2" placeholder="Correo">                                                     
                                                        <span class="text-danger" v-if="errores.email">{{errores.email[0]}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h6 class="text-light">Contraseña:</h6>
                                                        <input v-model="especialista.password" type="password" class="form-control" name="subject" id="subject" placeholder="Contraseña">                                                        
                                                        <span class="text-danger" v-if="errores.password">{{errores.password[0]}}</span>
                                                    </div>
                                                </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                         <h6 class="text-light">Confirmar Contraseña:</h6>
                                                        <input type="password" class="form-control" name="subject" id="subject" placeholder="Confirmar Contraseña">
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Especialidad:</h6>
                                                          
                                                            <select v-model="especialista.especialidad" id="especialidad" class="form-select"   placeholder="Especialidad" aria-label="Default select example">
                                                            
                                                                <option  v-for="esp in especialidades.data" :key="esp.id" :value="esp.id">{{esp.nombre}}</option>
                                                            
                                                            </select>
                                                            <span class="text-danger" v-if="errores.especialidad">{{errores.especialidad[0]}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Codigo Profesional:</h6>
                                                        <input  v-model="especialista.codigoProfesional" type="text" class="form-control" placeholder="Codigo Profesional" id="codigoProfesional">
                                                        
                                                        <span class="text-danger" v-if="errores.codigoProfesional">{{errores.codigoProfesional[0]}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <button class="btn btn-warning text-white" @click="guardar();">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Aqui-->
                            </div>
                       
                        <!-- Modal -->
                        <div class="modal" data-bs-backdrop="static" data-bs-keyboard="false" v-bind:class="{mostrar:showModal}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Exito</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   Se ha registrado satisfactoriamente, en 24 horas o menos tendra una respuesta.

                                </div>
                                <div class="modal-footer">
                                
                                   <a  :href="route('inicio')" class="btn btn-dark">Entendido</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--FinModal-->
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
          data() {
            return {
                showModal:false,
                especialista:{
                    id:'0',
                    name:'',
                    email:'',
                    password:'',
                    especialidad:'',
                    codigoProfesional:'',
                },
                errores:{},
               
                especialidades:[],
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            },
             async listar(){
                const res = await axios.get('/especialidads/',{params:this.todo,});
                this.especialidades = res.data;
            },
            async guardar(){
               try{
                    const res = await axios.post('/especialistas/',this.especialista);
                    if(res){
                       
                        
                         this.showModal=true;
                       
                    }                     
                }catch(error){
                    if(error.response.data){
                        this.errores = error.response.data.errors;
                    }
                }
                
            }
           
        },
         created(){
            this.listar();
          
        }
    })
</script>
<style>
.mostrar{
    display:list-item !important;
    opacity: 1;
    background-color: rgba(0,0,0,0.6);
}
</style>
