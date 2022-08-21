<template>
  <List :addbutton="addBtn"  >
    <template v-slot:title>
        Archivos de contenido
    </template>
    <template v-slot:items>
         <q-item  v-for="file in list" :key="file.id"  manual-focus   >
                   <q-item :inset-level="0"  exact clickable >
                        <q-item-section top avatar>
                        <q-icon
                            color="primary"
                            text-color="white"
                            name="edit_document"
                            size="40px"
                        />
                    </q-item-section>

                    <q-item-section >
                        <q-item-label>{{ file.name}}</q-item-label>
                
                    </q-item-section>
                  
                   </q-item>
          
                        <q-btn flat icon="delete" color="negative" aria-label="Eliminar Asignatura" dense @click="this.$refs.List.delete(file.id)"  />
                    
                </q-item>
    </template>
   </List>
</template>

<script>
import { computed ,ref, onMounted} from '@vue/runtime-core'
import List from '../misc/List.vue'
import axios from 'axios';
export default {
    name:"ListFile",
    components:{
        List
    },
    props:{

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
        const getFiles =  async ()=>{
            console.log("getting files")
            const res = await axios.get('/archivos',{
                params:{id_seccion:props.section.id}
            })
             list.value=res.data;
             console.log("res",res.data)
             console.log("files",list.value)
            
        }

        return{
            addBtn,
            list
        }
    }


}
</script>

<style>

</style>