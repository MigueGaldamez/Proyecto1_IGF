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
                                        <form method="POST" id="contactForm" name="contactForm" class="contactForm" novalidate="novalidate">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Nombre:</h6>
                                                        <input type="text" class="form-control" name="name2" id="name2" placeholder="Nombre">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Correo:</h6>
                                                        <input type="email" class="form-control" name="email2" id="email2" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                         <h6 class="text-light">Contraseña:</h6>
                                                        <input type="password" class="form-control" name="subject" id="subject" placeholder="Contraseña">
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
                                                            <select class="form-select" aria-label="Default select example">
                                                            <option selected>Especialidad</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                          <h6 class="text-light">Codigo Profesional:</h6>
                                                        <input type="email" class="form-control" name="email3" id="email3" placeholder="Codigo Profesional">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <button class="btn btn-warning text-white">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--Aqui-->
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
          data() {
            return {
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
            }
        }
    })
</script>
