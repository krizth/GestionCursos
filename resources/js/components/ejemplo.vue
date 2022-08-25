<template>
  <div ref="a" v-for="ar in array1" :key="ar" v-model:ej1="111" >
   
  </div>
</template>

<script>
import {computed,ref, reactive } from 'vue';
export default {
    name:"ejemplo",
    props:{
        ej1:{

        }
    },
    emits:["update:ej1"],
    setup(props,{emit}){
        const a=ref(null)
        const funcion1 =(val)=>{
            emit('update:ej1',val)
        }

        return{
            a,
            funcion:funcion1
        }
    }


}
</script>

<style>

</style>