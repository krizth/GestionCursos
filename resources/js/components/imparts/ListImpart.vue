<template>
    <div class="row" style="max-width:100%">
        <div class="col-4">
            <List :addbutton="false" >
                <template v-slot:title> Asignatura </template>
                <template v-slot:items>
                    <div class="q-gutter-md q-pa-sm">
                        <q-select
                            @update:model-value="saveSelectedOption"
                            v-model="targetCourse"
                            label="Seleccione una asignatura"
                            :options="courses"
                            name="asignatura"
                           
                        >
                            <template v-slot:option="scope">
                                <q-item v-bind="scope.itemProps">
                                    <q-item-section avatar>
                                        <q-icon
                                            name="menu_book"
                                            color="primary"
                                        />
                                    </q-item-section>
                                    <q-item-section>
                                        <q-item-label>{{
                                            scope.opt.label
                                        }}</q-item-label>
                                        <q-item-label caption>{{
                                            scope.opt.value.description
                                        }}</q-item-label>
                                    </q-item-section>
                                </q-item>
                            </template>
                        </q-select>
                    </div>
                </template>
            </List>
        </div>
        <div class="col-8">
            <List
                :addbutton="!!targetCourse"
                v-model:showAddForm="showAddForm"
                :deleteRoute="`${routes.delete.url}/${targetCourse?.value.id}`"
                ref="List"
            >
                <template v-slot:title> Imparte</template>
                <template v-slot:items>
                     <q-item v-for="user in users" :key="user.id"  manual-focus   >
                   <q-item :inset-level="0"  exact clickable @click="editImparts(user)" >
                        <q-item-section top avatar>
                        <q-icon
                            color="primary"
                            text-color="white"
                            name="person"
                            size="40px"
                        />
                    </q-item-section>

                    <q-item-section >
                        <q-item-label>{{ user.name }}</q-item-label>
                    </q-item-section>
                  
                   </q-item>
          
                        <q-btn flat icon="delete" color="negative" aria-label="Eliminar Profesor" dense @click="deleteImparts(user.id)"  />
                    
                </q-item>
                </template>
            </List>
        </div>
        <add-imparts
            :course="targetCourse?.value.id"
            :users="userList"
            :submit="routes.create"
            v-model:show="showAddForm"
        />
    </div>
</template>

<script>
import { ref, computed, onMounted } from "@vue/runtime-core";
import List from "../misc/List.vue";
import AddImparts from "./AddImparts.vue";
import { LocalStorage } from "quasar";

export default {
    name: "ListImparts",
    components: {
        List,
       AddImparts
    },
    props: {
        routes: {
            type: Object,
            required: true,
            default: () => ({
                edit: {
                    url: "",
                    method: "patch",
                },
                create: {
                    url: "",
                    method: "post",
                },
                delete: {
                    url: "",
                    method: "delete",
                },
            }),
        },
        users: {
            type: Array,
            default: () => [],
        },
        courses: {
            type: Array,
            default: () => [],
        },
    
    },
    setup(props) {
        const showEditModal = ref(false);
        const showAddForm = ref(false);
        const target = ref();
        const saveSelectedOption = (val) => {
            LocalStorage.set("selected-asignatura", val);
        };
        const deleteSelectionOption = () => {
            LocalStorage.remove("selected-asignatura");
        };
        const userList=computed(()=>props.users.map((user)=>({
            label:user.name,
            value:user.id
        })));
    
        onMounted(() => {
            const selected = LocalStorage.getItem("selected-asignatura");
            const incoming = props.courses.find(x => x.id == selected?.value.id);
            incoming == undefined
                ? deleteSelectionOption()
                : (targetCourse.value = {
                      label: incoming.title,
                      value: { ...incoming },
                  });
        });
        const editImparts = (val) => {
            target.value = val;
            showEditModal.value = true;
        };
        const deleteImparts = (val) => {
            List.value.delete(val);
        };

        const courses = computed(() =>
            props.courses.map((course) => ({
                label: course.title,
                value: { ...course },
            }))
        );
        const targetCourse = ref(undefined);
        const users = computed(() =>
            targetCourse.value ? targetCourse.value.value.users : []
        );
        const files = computed(()=>props.files)
        const List=ref();

        return {
            target,
            userList,
            courses,
             targetCourse,
            users,
            showAddForm,
            showEditModal,
            deleteImparts,
            editImparts,
            saveSelectedOption,
            files,
            List
        };
    },
};
</script>
<style scoped>

</style>

