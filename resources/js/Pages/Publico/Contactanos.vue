<template>
    <front-end title="Dashboard">     
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    
                   
                   <div class="row justify-content-center">
                    
                       
                            <div class="row no-gutters">
                            <!--aUI-->
                                <div class="col-md-6 d-flex align-items-stretch izquierdo">
                                    <div class="contact-wrap w-100 p-md-5 p-4 py-5">
                                          <h3 class="mb-4 text-light">Escribenos</h3> 
                                        <form method="POST" id="contactForm" name="contactForm" class="contactForm" novalidate="novalidate">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="message" class="form-control" id="message" cols="30" rows="6" placeholder="Mensaje"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-warning text-white">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--aUI-->
                                <div class="col-md-6 d-flex align-items-stretch derecho">
                                    <div class="info-wrap w-100 p-md-5 p-4 py-5 img">
                                        <h3 class="text-light">Informacion de contacto</h3>
                                        <p class="mb-4 text-light">Estamos abiertos a sugerencias</p>
                                        <div class="dbox w-100 d-flex align-items-start">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-map-marker"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Direccion:</span> 29 Cl Pte y 11 Av Nte Bo San Miguelito</p>
                                            </div>
                                        </div>
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
    })
</script>
