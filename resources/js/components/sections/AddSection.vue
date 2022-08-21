<template>
    <Add v-model:submit="route" v-model:show="showAddModal">
        <template v-slot:title>
            Agregar una Seccion a {{course.title}}
        </template>
        <template v-slot:form >
            <div class="q-gutter-md q-pa-sm">
                  <q-input name="title" v-model="formData.title" type="text" label="Titulo de la seccion de la asignatura"/>
                <q-input name="description" v-model="formData.description" type="textarea" label="Descripción"/>
                <input type="hidden" name="id_asignatura" :value="course.id"/>
           </div>
        </template>
        <template v-slot:actions>
            <q-btn no-caps color="primary" label="Guardar" type="submit" />
            <q-btn no-caps color="negative" label="Cancelar" v-close-popup />
        </template>
    </Add>
</template>

<script>
import { computed, ref } from '@vue/runtime-core';
import Add from '../misc/Add.vue';
export default {
    name:'AddSection',
  components: { Add },
    props: {
        show: {
            type: Boolean,
            default: false,
        },
        submit:{
            type:Object,
            default:()=>({
                url:"",
                method:""
            })

        },
        course:{
            type:Object,
            default:()=>({}),
            required:true
        }
    
    },
    emits:["update:show"],
    setup(props,{emit}){
        const formData=ref({
            title:"",
            description:"",
            course:undefined
        })
        
        const route=computed(()=>props.submit)
        const showAddModal=computed({
            get:()=>props.show,
            set:(val)=>emit('update:show',val)
        })
        const course = computed(()=>props.course)
        return {
            showAddModal,
            course,
            formData,
            route
        }
    }
};
</script>

<style  >


</style>
