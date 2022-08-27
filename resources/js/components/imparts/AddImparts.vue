<template>
    <Add v-model:submit="route" v-model:show="showAddModal">
        <template v-slot:title>
            Imparte asignatura
        </template>
        <template v-slot:form >
            <div class="q-gutter-md q-pa-sm">
                <q-select :options="users" name="id_user" v-model="formData.id_user" type="text" label="Usuario"/>
                <input name="id_asignatura" v-model="formData.id_asignatura" type="hidden" />
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
    name:'AddImparts',
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
        users:{
            type:Array,
            default:()=>([])
        },
        course:{
            type:Number,
            required:true
        }
    
    },
    emits:["update:show"],
    setup(props,{emit}){
        const id_asignatura=computed(()=>props.course);
        const formData=ref({
            id_user:"",
            id_asignatura:id_asignatura
        });
        const route=computed(()=>props.submit)
        const showAddModal=computed({
            get:()=>props.show,
            set:(val)=>emit('update:show',val)
        })
        const users=computed(()=>props.users)
        return {
            showAddModal,
            formData,
            route,
            users,
        }
    }
};
</script>

<style></style>
