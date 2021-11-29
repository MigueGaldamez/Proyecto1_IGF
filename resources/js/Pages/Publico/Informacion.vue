<template>
    <front-end title="Dashboard">     
         <!---->
        
        <div class="p-5 mb-4 rounded-3 bg-gray-200">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">Informacion del Sistema</h1>
                <p class="col-md-9 fs-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <button class="btn btn-secondary btn-lg boton-principal" type="button">Registrarse</button>
            </div>
        </div>

            




        <div class="container marketing">
            <div class="row">
                <div class="col-lg-4">            
                    <h2>Vision</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat..</p>
                    <p><a class="btn btn-secondary colorOscuro" href="#">Ver más detalles &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <h2>Mision</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat..</p>
                    <p><a class="btn btn-secondary colorOscuro" href="#">Ver más detalles &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">

                    <h2>Valores</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat..</p>
                    <p><a class="btn btn-secondary colorOscuro" href="#">Ver más detalles &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->

            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Totalmente personalisadas. <span class="text-muted">Solo tú y el especialista</span></h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</p>
                </div>
                <div class="col-md-5">
                    <img src="https://image.freepik.com/free-vector/speech-therapy-abstract-concept-vector-illustration-speech-pathology-therapy-improve-language-development-delay-speaking-disability-treatment-tongue-exercise-home-abstract-metaphor_335657-1577.jpg"  width="400" height="400" />
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                     <h2 class="featurette-heading">Atencion las 24horas. <span class="text-muted">Te sorprendera</span></h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="https://image.freepik.com/free-vector/service-24-7-concept-illustration_114360-7620.jpg"  width="400" height="400" />
                    

                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                     <h2 class="featurette-heading">Especialistas de todas las ramas. <span class="text-muted">para garantizar tu respuesta </span></h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</p>
                </div>
                <div class="col-md-5">
                    <img src="https://image.freepik.com/free-vector/flat-customer-support-illustration_23-2148899114.jpg"  width="400" height="400" />

                </div>
            </div>

            <hr class="featurette-divider">

          

        </div>

        <!---->
      
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
