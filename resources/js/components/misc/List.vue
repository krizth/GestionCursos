<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <span class="col"><slot name="title"></slot></span>
                            <div class="col text-right no-wrap">
                                <q-btn
                                    icon="add"
                                    dense
                                    no-caps
                                    no-wrap
                                    color="primary"
                                    @click="()=>showAdd=true"
                                    v-show="addbtn"
                                    aria-label="Agregar Asignatura"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <q-list>
                            <slot name="items">

                                </slot>
                        </q-list>
                    </div>
                </div>
            </div>
        </div>
        <slot name="edit">

        </slot>
    </div>
</template>

<script>
import { computed } from "@vue/runtime-core";
import { useQuasar } from "quasar";
import axios from "axios";
export default {
    props:{
        deleteRoute:{
            type:String,
            default:"",
        },
        showAddForm:{
            type:Boolean,
            default:false
        },
        addbutton:{
            type:Boolean,
            required:false,
            default:true
        }

    },
    emits:["update:showAddForm",'update:addbutton'],
    setup(props,{emit, expose}) {
        const addbtn=computed({
            get:()=>props.addbutton,
            set:(val)=>emit('update:addbutton',val)
        })
       const q= useQuasar();
        const showAdd = computed({
            get:()=>props.showAddForm,
            set:(val)=> emit('update:showAddForm',val)
        })
        const deleteItem = (id)=>{
            q.dialog({
                title:"Eliminar",
                message:"Realmente desea eliminar este elemento?",
                cancel:true
            }).onOk(()=>{
                axios.delete(decodeURI(props.deleteRoute).replace('?',id)).then(()=>{
                   window.location.href = window.location.href;
                });
            })
        }
        expose({delete:deleteItem})
        return {
            showAdd,
            deleteItem,
            addbtn
        }
    },
}
</script>
