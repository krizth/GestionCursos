<template>
  <div>
      <List v-model:showAddForm="showAddForm">
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
          
                        <q-btn flat icon="delete" color="negative" dense  />
                    
                </q-item>
        </template>
    </List>
    <add-course :submit="routes.create" v-model:show="showAddForm"/>
    <edit-course :submit="routes.edit" v-model:showEditModal="showEditModal" v-model:target=" target" />
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
        }
    },
    setup(props) {
        const showEditModal=ref(false)
        const showAddForm=ref(false)
        const target=ref()
        const action=computed(()=>{
            return props.routes
        })
        const editCourse=(val)=>{
            target.value=val
            showEditModal.value=true;
        }
        const courses = ref([
            {
                id: 1,
                title: "Curso 1",
                description:
                    "Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.",
            },
            {
                id: 2,
                title: "Curso 2",
                description:
                    "Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.",
            },
            {
                id: 3,
                title: "Curso 3",
                description:
                    "Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.",
            },
        ]);
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
