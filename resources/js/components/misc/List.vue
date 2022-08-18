<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
import { computed, ref } from "vue";
import { useQuasar } from "quasar";
export default {
    props:{
        deleteRoute:{
            type:String,
            default:"",
        },
        showAddForm:{
            type:Boolean,
            default:false
        }

    },
    emits:["update:showAddForm"],
    setup(props,{emit}) {
        const q= useQuasar();
        const showAdd = computed({
            get:()=>props.showAddForm,
            set:(val)=> emit('update:showAddForm',val)
        })
        const deleteItem = ()=>{
            q.dialog({
                title:"Eliminar",
                text:"Realmente desea eliminar este elemento?",
                cancel:true,
                persistent:true
            }).onOk(()=>{
                windows.location.href=deleteRoute;
            })
        }
        return {
            showAdd,
            deleteItem
        }
    },
}
</script>
