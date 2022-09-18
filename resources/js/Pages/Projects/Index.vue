<template>
     <app-layout border="border-b border-gray-100">
         <template #header>
             <div class="relative">
                 <div class="flex">
                     <div class="flex flex-col gap-y-3">
                         <span class=" uppercase text-sm font-thin text-gray-500">
                             {{project.team.title}}
                         </span>
                         <h1 class="text-3xl font-extrabold font-serif uppercase">
                             {{project.title}}
                         </h1> 
                     </div>
                     <div class="absolute right-0 top-7">
                         <div class="inline-flex gap-x-3">
                             <img class=" w-6" src="../../../../public/images/github3.png" alt="">
                             <img class=" w-6" src="../../../../public/images/slack1.png" alt="">
                             <img class=" w-6" src="../../../../public/images/web-link.png" alt="">
 
                         </div>
                     </div>
                 </div>
                 <div class="flex justify-between mt-5">
                     <div class="inline-flex gap-x-3 font-bold text-gray-500">
 
                         <button @click = "tab = 'index'"
                             class="rounded-md -ml-3 py-[5px] px-3"
                             :class="{'bg-gray-200 text-sky-600': tab == 'index'}">Overview</button>
                         <button @click = "tab = 'boards'"
                             class="rounded-md  py-[5px] px-3"
                             :class="{'bg-gray-200 text-sky-600': tab == 'boards'}">tasks</button>
 
                         <button @click = "tab = 'people'"
                             class="rounded-md  py-[5px] px-3"
                             :class="{'bg-gray-200 text-sky-600': tab == 'people'}">people</button>
 
                     </div>
                     <div>
                         <div class="inline-flex gap-x-3">
                             <button v-if="tab == 'boards' && (permissions.indexOf('create_board') !== -1 || permissions.indexOf('*') !== -1)" @click="showModal = true;"
                                 class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center">Create
                                 Board</button>
                             <button v-else-if="tab == 'index' && $page.props.user && !userProjectInfo.isOwner && !userProjectInfo.isJoined"
                                 @click="reqPermission()"
                                 class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                                 Request Permission </button>
                             
                             <button  @click="sideNav = true" class="px-7 py-1 border rounded-md">
                                 <img src="../../../../public/images/chat-svgrepo-com.svg" width="20" height="20"
                                     alt="chat">
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
 
         </template>

        <Main :project="project" v-if="tab === 'index'" />
        <Boards :project="project" :permissions="permissions" v-else-if="tab === 'boards'" @closeModal="showModal = false" :showModal="showModal" />
        <People :project="project" v-else-if="tab === 'people'" />

 
     </app-layout>
     
 
     <Modal :sideNav="sideNav" maxWidth="sm" :show="sideNav" @close="sideNav = false">
         <header class="p-5 border-b">
             <h3> Project Chat </h3>
 
         </header>
 
         <chat />
         <!-- <Summary /> need ui fix-->
     </Modal>
 </template>
 
 <script>
 import { Head } from '@inertiajs/inertia-vue3';
 import { defineComponent } from 'vue'
 import AppLayout from '@/Layouts/AppLayout.vue'
 import Modal from '@/Jetstream/Modal'
 import Chat from './Partials/Chat.vue'
 import Main from './Main.vue'
 import Boards from './Boards.vue'
 import People from './People.vue'
 export default defineComponent({
     props: ['boards',  'project', 'token', 'permissions', 'userProjectInfo'],
     components: {
         AppLayout,
         Head,
         Modal,
         Main,
         Boards,
         Chat,
         People
     },
     data() {
         return {
             tab : "index",
             sideNav: false,
             showModal: false
         }
     },
 
     methods: {
         reqPermission() {
            this.$inertia.post(route('project.join', {project: this.project.id}))
         }
     }
 })
 </script>
