<template>
     <Add v-model:show="showEditModal" v-model:submit="submitRoute">
        <template v-slot:title>
            Editar Asignatura
        </template>
        <template v-slot:form >
            <div class="q-gutter-md q-pa-sm">
                <q-input name="title" v-model="targetEditItem.title" type="text" label="Nombre del curso o asignatura"/>
                <q-input name="description" v-model="targetEditItem.description" type="textarea" label="Descripción de la asignatura"/>
               <input type="hidden" name="id_asignatura" :value="course.id"/>
                <input type="hidden" name="_method" value="PUT">
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
    name:"EditSection",
    components:{
        Add
    },
    props:{
        course:{
            type:Object,
            required:true,
              default:()=>({
                id:0,
                title:""
            })
        
        },
       submit :{
            type:Object,
            required:true,
            default:()=>({
                url:"",
                method:"",
                csrf:""
            })
        },
        target:{
            type:Object,
            default:()=>{},
        },
        showEditModal:{
            type:Boolean,
            default:false
        }
    },
    emits:["update:target","update:showEditModal"],
    setup(props,{emit}) {
     const targetEditItem=computed({
        get:()=>props.target,
        set:(val)=>emit('update:target',val)
     })
      const submitRoute = computed(()=>({...props.submit,url:decodeURI(props.submit.url).replace('?',targetEditItem.value?.id)}));
     const showEditModal=computed({
        get:()=>props.showEditModal,
        set:(val)=>emit("update:showEditModal",val)
     })
     const course = computed(()=>props.course);
     return {
        targetEditItem,
        showEditModal,
        submitRoute,
        course
     }
    }


}
</script>

<style>

</style>