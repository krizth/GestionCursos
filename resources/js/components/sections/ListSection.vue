<template>
    <div class="row full-width">
        <div class="col-4">
            <List :addbutton="false">
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
                :deleteRoute="routes.delete.url"
                ref="List"
            >
                <template v-slot:title> Secciones</template>
                <template v-slot:items>
                    <q-item
                        v-for="section in sections"
                        :key="section.id"
                        manual-focus
                    >
                        <q-expansion-item
                            expand-separator
                            icon="topic"
                            size="40px"
                        >
                            <template v-slot:header>
                                <div class="row">
                                    <div class="col-2 text-left">
                                        <q-icon
                                            color="primary"
                                            name="topic"
                                            size="30px"
                                        />
                                    </div>
                                    <div class="col-7 text-left">
                                        <div class="row">
                                            <div class="col-4">
                                                {{ section.title }}
                                            </div>
                                            <div class="col-8">
                                                {{ section.description }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <q-btn
                                            flat
                                            icon="edit"
                                            color="primary"
                                            aria-label="Eliminar Seccion"
                                            dense
                                            @click="editSection(section)"
                                        />
                                        <q-btn
                                            flat
                                            icon="delete"
                                            color="negative"
                                            aria-label="Eliminar Seccion"
                                            dense
                                            @click="deleteSection(section.id)"
                                        />
                                    </div>
                                </div>
                            </template>
                            <div class="q-mt-md">
                                <ListFile :routes="files" :section="section" ref="listfile" :addbutton="!!targetCourse" />
                            </div>
                        </q-expansion-item>
                        <div class="items-center"></div>
                    </q-item>
                </template>
            </List>
        </div>
        <add-section
            :course="targetCourse?.value"
            :submit="routes.create"
            v-model:show="showAddForm"
        />
        <edit-section
            :course="targetCourse?.value"
            :target="target"
            v-model:showEditModal="showEditModal"
            :submit="routes.edit"
        />
    </div>
</template>

<script>
import { ref, computed, onMounted, watch } from "@vue/runtime-core";
import List from "../misc/List.vue";
import AddSection from "./AddSection.vue";
import EditSection from "./EditSection.vue";
import { LocalStorage } from "quasar";
import ListFile from "../files/ListFile.vue";

export default {
    name: "ListSection",
    components: {
        List,
        AddSection,
        EditSection,
        ListFile,
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
        files:{
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
        courses: {
            type: Array,
            required: true,
            default: () => ({}),
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
        const editSection = (val) => {
            target.value = val;
            showEditModal.value = true;
        };
        const deleteSection = (val) => {
            List.value.delete(val);
        };

        const courses = computed(() =>
            props.courses.map((course) => ({
                label: course.title,
                value: { ...course },
            }))
        );
        const targetCourse = ref(undefined);
        const sections = computed(() =>
            targetCourse.value ? targetCourse.value.value.secciones : []
        );
        const files = computed(()=>props.files)
        const List=ref();
        return {
            target,
            courses,
            targetCourse,
            sections,
            showAddForm,
            showEditModal,
            deleteSection,
            editSection,
            saveSelectedOption,
            files
        };
    },
};
</script>
<style scoped></style>
