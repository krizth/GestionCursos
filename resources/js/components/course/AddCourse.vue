<template>
    <Add :submit="submit" v-model:show="showAddModal">
        <template v-slot:title>
            Agregar Asignatura
        </template>
        <template v-slot:form >
            <div class="q-gutter-md q-pa-sm">
                <q-input name="title" v-model="formData.title" type="text" label="Nombre del curso o asignatura"/>
                <q-input name="description" v-model="formData.description" type="textarea" label="Descripción de la asignatura"/>
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
    name:'AddCourse',
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

        }
    
    },
    emits:["update:show"],
    setup(props,{emit}){
        const formData=ref({
            title:"",
            description:""
        })
        const showAddModal=computed({
            get:()=>props.show,
            set:(val)=>emit('update:show',val)
        })
        return {
            showAddModal,
            formData
        }
    }
};
</script>

<style></style>
