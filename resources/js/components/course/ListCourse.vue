<template>
  <div class="col-md-8 offset-2">
      <List v-model:showAddForm="showAddForm" :deleteRoute="routes.delete.url" ref="List">
        <template v-slot:title> Lista de Asignaturas </template>
        <template v-slot:items>
                  <q-item v-for="course in courses" :key="course.id"  manual-focus   >
                   <q-item :inset-level="0"  exact clickable @click="editCourse(course)" >
                        <q-item-section top avatar>
                        <q-icon
                            color="primary"
                            text-color="white"
                            name="menu_book"
                            size="40px"
                        />
                    </q-item-section>

                    <q-item-section >
                        <q-item-label>{{ course.title }}</q-item-label>
                        <q-item-label caption lines="2">
                            {{ course.description }}
                        </q-item-label>
                    </q-item-section>
                  
                   </q-item>
          
                        <q-btn flat icon="delete" color="negative" aria-label="Eliminar Asignatura" dense @click="this.$refs.List.delete(course.id)"  />
                    
                </q-item>
        </template>
    </List>
    <add-course :submit="routes.create" v-model:show="showAddForm"/>
    <edit-course :submit="routes.edit" v-model:showEditModal="showEditModal" v-model:target="target" />
  </div>
</template>

<script>
import { ref ,computed } from "@vue/runtime-core";
import List from '../misc/List.vue'
import AddCourse from './AddCourse.vue'
import EditCourse from "./EditCourse.vue";
export default {
    name:"ListCourse",
    components:{
    List,
    AddCourse,
    AddCourse,
    EditCourse
},
    props:{
        routes:{
            type:Object,
            required:true,
            default:()=>({
                edit:{
                    url:"",
                    method:"patch"
                },
                create:{
                        url:"",
                        method:"post"
                    },
                    delete:{
                        url:"",
                        method:"delete"
                    }
                })
        },
        courses:{
            type:Array,
            required:true,
            default:()=>({

            })
        }
    },
    setup(props) {
        const showEditModal=ref(false)
        const showAddForm=ref(false)
        const target=ref()
        const action=computed(()=>{
            return props.routes
        })
        console.log("courses",props.courses)
        const editCourse=(val)=>{
            target.value=val
            showEditModal.value=true;
        }
        const courses = computed(()=>props.courses)
        return {
             target,
            courses,
            showAddForm,
            showEditModal,
            editCourse
           
        };
    },
};
</script>
