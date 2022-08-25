<template>
    <Add v-model:submit="route" v-model:show="showAddForm">
        <template v-slot:title>
            Agregar un archivo a la seccion: {{secction.title}}
        </template>
        <template v-slot:form >
            <div class="q-gutter-md q-pa-sm">
                  <q-input name="name" v-model="formData.name" type="text" label="Nombre del archivo"/>
                <input class="form-control input" name="file" type="file" label="Archivo"/>
                <input type="hidden" name="id_seccion" :value="secction.id"/>
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
    name:'AddFile',
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
        secction:{
            type:Object,
            default:()=>({}),
            required:true
        }
    
    },
    emits:["update:show"],
    setup(props,{emit}){
        const formData=ref({
            name:"",
            file:"",
            secction:undefined
        })
        
        const route=computed(()=>props.submit)
        const showAddForm=computed({
            get:()=>props.show,
            set:(val)=>emit('update:show',val)
        })
        const secction = computed(()=>props.secction)
        return {
            showAddForm,
            secction,
            formData,
            route
        }
    }
};
</script>

<style  >


</style>
