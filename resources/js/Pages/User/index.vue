<template>
    <app-layout>
         <div class="mt-10">
              <figure class="text-center  max-w-fit  mx-auto ">
                   <img class="rounded-full mx-auto max-h-60 border-4 border-transparent ring-1" src="../../../../public/images/pl.jpg" alt="">
                    <figcaption class="font-bold font-sans text-3xl mt-10">Fitsum Belay</figcaption>
                    <p class="pt-5 pb-1 text-gray-600 ">hello am fitsum making dum thing again and again</p>
                    <p class="text-gray-600">#software #python #c #js</p>
              </figure>
               <div class="flex justify-center gap-7 my-10 font-bold">
                    <span class="border-b-2 border-blue-600 pb-4 active text-blue-600"> Projects </span>
                    <span> Blogs </span>
                    <span> About </span>
                    <span> Info </span>
               </div>

             

               <div class=" grid grid-cols-4 max-w-5xl gap-5">
                    <div v-for="i in 20" :key="i" class=" shadow bg-gray-50 rounded-lg overflow-hidden">
                        <figure class="p-0">
                             <div class="relative">
                                  <img class="shadow-xl border-b  w-full h-full rounded-lg rounded-b-md border border-gray-100" :src="`${'https://picsum.photos/200/300?random='}` + i" alt="">
                             </div>
                         <figcaption class="p-4 pb-2 font-sans font-bold ">Project Name</figcaption>
                         <div class="p-4 pt-0 text-sm text-gray-400">
                              <p>Somthing to say here</p> 
                               <p>progress --------</p>
                         </div>
                        </figure>
                    </div>
               </div>
         </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import AppLayout from "../../Layouts/AppLayout.vue";
export default defineComponent({
     components: {
          AppLayout
     }
})
</script>