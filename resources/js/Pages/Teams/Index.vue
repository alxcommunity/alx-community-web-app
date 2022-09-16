<template>
      <app-layout>
           <div class=" flex justify-center ">
                    <div class="container">
                         <div class="py-2 text-4xl font-extrabold
                         h-screen flex justify-between">
                              <div>
                                   <h1>Teams</h1>
                                   <h1>Logo</h1>
                                   <h1>Here is the jet logo </h1>

                              </div>
                              <div class="flex w-2/5 overflow-hidden">
                                       
                                       <div class="w-full flex flex-col gap-y-2">
                                           <img src="../.../../../../../public/images/logo.png" alt="">
                                             
                                       </div>
                              </div>
                         </div>
                         <div class="py-10 -mt-[27em]">
                              <div class="text-2xl font-extrabold w-full my-10"> <h1>Teams</h1> </div>
                              <div class="grid grid-cols-4 gap-4 gap-y-10">
                                  

                                   <div class="card bg-white  p-4 rounded-md border shadow-sm" v-for="team in teams" :key="team.id">
                                        <div class="flex gap-4">
                                             <img class="rounded-full h-14" :src="`${'https://ui-avatars.com/api/?name='+team.name}`" alt="">
                                             <div>
                                                  <h1 class="text-md font-bold text-gray-800 first-letter:uppercase">{{team.name}}</h1>
                                                  <p class="text-sm text-gray-600 line-clamp-2">this is team of lions sdsdf sdfsd sdfsdf sdfsdf sdfs sdfsd fiba is sdfs sdfsdf sdfsdf sdfs sdfsd fiba is sdfs</p>
                                                  
                                             </div>
                                        </div>
                                        <div class="flex justify-between pl-2">
                                             
                                             <span class="text-sm text-gray-500 py-4">Projects : 3</span>
                                             <div class="flex ml-4  pt-3">
                                             <img class="h-8 rounded-full border border-gray-50 -ml-3" :src="`${'https://ui-avatars.com/api/?name='+team.name}`" alt="">
                                             <img class="h-8 rounded-full border border-gray-50 -ml-3" :src="`${'https://ui-avatars.com/api/?name='+team.name}`" alt="">
                                             <img class="h-8 rounded-full border border-gray-50 -ml-3" :src="`${'https://ui-avatars.com/api/?name='+team.name}`" alt="">
                                             </div>
                                   

                                        </div>
                                   </div>

                                  
                              </div>
                              
                         </div>
                    </div>
           </div>
           
           </app-layout>

         
</template>

<script>
     import { Head, Link } from '@inertiajs/inertia-vue3';
     import { defineComponent } from 'vue'
     import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
         props: ['teams'],
        components: {
            AppLayout,
            Head,
            Link,
          
        },
    })
</script>