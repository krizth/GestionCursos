<template>
     <Add v-model:show="showEditModal" :submitRoute="submitRoute">
        <template v-slot:title>
            Editar Asignatura
        </template>
        <template v-slot:form >
            <div class="q-gutter-md q-pa-sm">
                <q-input name="title" v-model="targetEditItem.title" type="text" label="Nombre del curso o asignatura"/>
                <q-input name="description" v-model="targetEditItem.description" type="textarea" label="Descripción de la asignatura"/>
            </div>
        </template>
        <template v-slot:actions>
            <q-btn  no-caps color="primary" label="Guardar" type="submit" />
            <q-btn no-caps color="negative" label="Cancelar" v-close-popup />
        </template>
    </Add>
</template>

<script>
import { computed } from '@vue/runtime-core'
import Add from '../misc/Add.vue'
export default {
    name:"EditCurse",
    components:{
        Add
    },
    props:{
       submit :{
            type:Object,
            required:true,
            default:()=>({
                url:"",
                method:""
            })
        },
        target:{
            type:Object,
            default:()=>{}
        },
        showEditModal:{
            type:Boolean,
            default:false
        }
    },
    emits:["update:target","update:showEditModal"],
    setup(props,{emit}) {

    const submitRoute = computed(()=>props.editRoute)
     const targetEditItem=computed({
        get:()=>props.target,
        set:(val)=>emit('update:target',val)
     })
     const showEditModal=computed({
        get:()=>props.showEditModal,
        set:(val)=>emit("update:showEditModal",val)
     })
     return {
        targetEditItem,
        showEditModal,
        submitRoute
     }
    }


}
</script>

<style>

</style>