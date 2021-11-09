<template>
    <jet-form-section v-if="  this.form.especialidad !=''">
        <template #title>
            Informacion de Especialidad
        </template>

        <template #description>
            Actualizar la especialidad
        </template>

        <template #form>
            
            <!-- Name -->
          

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Codigo Profesional" />
                <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.codigoProfesional" />
             
            </div>
            <div class="col-span-6 sm:col-span-4">
              
                <jet-label for="email" value="Especialidad" />
                <select v-model="form.especialidad" id="especialidad" class="form-select" aria-label="Default select example">
                    <option selected>Abre este menu</option>
                    <option  v-for="esp in especialidades.data" :key="esp.id" :value="esp.id">{{esp.nombre}}</option>
                
                </select>
            </div>
            
        </template>

        <template #actions>
            <span v-if="guardado">Guardado</span>

            <jet-button @click="actualizar();">
                Guardar
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                guardado:false,
                form:{
                    codigoProfesional:'',
                    especialidad:'',
                },
                todo:{
                    page:1,
                    per_page:50,
                },
                especialidades:[],
                photoPreview: null,
            }
        },

        methods: {
            async listar(){
                const res2 = await axios.get('/especialidads/',{params:this.todo,});
                this.especialidades = res2.data;
                const res = await axios.get('/obtener/especialista');
                console.log(res.data);
                if(res.data!=0){
                     this.form.especialidad = res.data.idEspecialidad;
                     this.form.codigoProfesional = res.data.reconocimiento;
                }
               
               
            },
            async actualizar() {
                
                const res = await axios.post('/editar/perfil/especialista',this.form);
                this.guardado=true;
             
            },

          
        },
         created(){
            this.listar();
        }
    })
</script>
