<template>
    <front-end title="Dashboard">     
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    
                   
                   <div class="row justify-content-center">
                    
                       
                            <div class="row no-gutters">
                            <!--aUI-->
                                <div class="col-md-8 d-flex align-items-stretch izquierdo">
                                    <div class="contact-wrap w-100 p-md-5 p-4 py-5">
                                          <h2 class="mb-4 text-light">Iniciar Sesión</h2> 
                                        <form  @submit.prevent="submit">
                                            <div class="row">
                                               
                                                <div class="col-md-12 mb-10">
                                                    <h4 class="text-light">Correo:</h4>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"  v-model="form.email" required autofocus>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 mb-10">
                                                     <h4 class="text-light">Contraseña:</h4>
                                                    <div class="form-group">
                                                         <input type="password" class="form-control" id="password" placeholder="contraseña" v-model="form.password" required autocomplete="current-password" />
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
                                                    <label class="form-check-label text-white" for="flexCheckDefault">
                                                       Recuerdame
                                                    </label>
                                                </div>
                                                </div>
                                                 
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-warning text-white btn-lg" type="submit">Iniciar sesión</button>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--aUI-->
                                <div class="col-md-4 d-flex align-items-stretch derecho">
                                    <div class="info-wrap w-100 p-md-5 p-4 py-5 img">
                                        <h3 class="text-light">Informacion de contacto</h3>
                                        <p class="mb-4 text-light">Problemas iniciando sesión?</p>
                                      
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-phone"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Telefono:</span> <a href="">2245-3369</a></p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-paper-plane"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>correo:</span> <a href="mailto:asesoriaEnLinea@asesoria.com">asesoriaEnLinea@asesoria.com</a></p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-globe"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Sito web</span> <a href="">asesoriaEnLinea.sv</a></p>
                                            </div>
                                        </div>
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
        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
