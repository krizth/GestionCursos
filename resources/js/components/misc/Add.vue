<template>
    <q-dialog v-model="showModal" full-width position="top">
        <q-card class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><slot name="title" class="modal-title bold"></slot></div>
                          <div class="col text-right no-wrap">
                            <q-btn v-close-popup icon="close"  flat dense />
                          </div>
                </div>
                
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data"  :action="action.url" :method="action.method" class="form form-control">
                    <slot name="form" class="gap-3"> </slot>
                    <q-card-actions>
                        <slot name="actions" class="gap-2 p-2"> </slot>
                    </q-card-actions>
                    <input type="hidden" :value="action.csrf" name="_token"/>
                </form>
            </div>
        </q-card>
    </q-dialog>
</template>

<script>
import { ref, computed } from "@vue/runtime-core";
export default {
    props: {
        show: {
            type: Boolean,
            default: false,
        },
        submit: {
            type: Object,
            default: ()=>({
                url:"",
                method:"",
            }),
        },
    },
    emits: ["update:show", "update:submit"],
    setup(props, { emit }) {
        const showModal = computed({
            get: () => props.show,
            set: (val) => emit("update:show", val),
        });
      
        const action = computed({
            get() {
              
                return props.submit;
            },
            set(val) {
                emit("update:submit", val);
            },
        });
        
        return {
            showModal,
            action,
        };
    },
};
</script>

<style></style>
