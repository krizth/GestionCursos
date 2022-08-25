<template>
 <div>
     <List :addButton="addBtn" v-model:showAddForm="showAddForm" :deleteRoute="routes.delete.url" ref="List"  >
    <template v-slot:title>
        Archivos de contenido
    </template>
    <template v-slot:items>
         <q-item  v-for="file in list" :key="file.id"  manual-focus  >
                   <q-item :inset-level="0"  exact clickable  @click="downloadFile(file)">
                        <q-item-section top avatar>
                            <q-circular-progress
                            indeterminate
                            size="40px"
                            v-if="file.loading"
                           
                            />
                        <q-icon
                            color="primary"
                            text-color="white"
                            name="edit_document"
                            size="40px"
                            v-else
                        />
                    </q-item-section>

                    <q-item-section >
                        <q-item-label>{{ file.name}}
                         
                        </q-item-label>
                 
                    </q-item-section>
                  
                   </q-item>
          
                        <q-btn flat icon="delete" color="negative" aria-label="Eliminar Asignatura" dense @click="this.$refs.List.delete(file.id)"  />
                       
                </q-item>
    </template>
   </List>
   <add-file :submit="routes.create" :secction="section" v-model:show="showAddForm"/>
 </div>
</template>

<script>
import { computed ,ref, onMounted} from '@vue/runtime-core'
import List from '../misc/List.vue'
import axios from 'axios';
import AddFile from './AddFile.vue';
export default {
    name:"ListFile",
    components:{
        List,
        AddFile
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
        addButton:{
            type:Boolean,
            default:false
        },
        section:{
            type:Object,
            default:()=>({id:0})
        }
    },
    setup(props){
        const addBtn=computed(()=>props.addButton);
        onMounted( async()=>{
             await getFiles();
        })
        const list = ref(undefined)
        const section =computed(()=>props.section)
        const getFiles =  async ()=>{
            console.log("getting files")
            const res = await axios.get('/archivos',{
                params:{id_seccion:props.section.id}
            })
             list.value=res.data.map(x=>({...x,loading:false})); 
        }
        const showAddForm=ref(false);
        const routes = computed(()=>props.routes)
        const downloadFile = async (file)=>{
            console.log("Downloading...")
            file.loading=true;
           const req= await axios.get(file.url,{
                method:"GET",
                responseType:'blob'
            })
            var fileURL = window.URL.createObjectURL(new Blob([req.data]));
                    var fileLink = document.createElement('a');
                
                    fileLink.href = fileURL;
                    fileLink.setAttribute('download',`${file.name}.${file.mimetype}` );
                    document.body.appendChild(fileLink);
                
                    fileLink.click();
                    file.loading=false;
            
        }
     
        return{
            list,
            addBtn,
            routes,
            section,
            showAddForm,
            downloadFile

        }
    }


}
</script>

<style>

</style>