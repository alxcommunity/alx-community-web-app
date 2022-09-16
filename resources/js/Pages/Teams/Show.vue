<template>
    <app-layout title="Name Team" border="border-b border-gray-100" mx="mx-0">
        <template #hgroup>
            <div class="relative py-4 px-10">
                 <div class="flex justify-between mt-2">
                    <!-- <div class="flex gap-x-3 font-bold text-gray-500">
                      Projects
                    </div> -->


                    <div class="flex gap-x-2">

                        <figure v-for="member in team.users" :key="member.id" class="rounded-full overflow-hidden">
                            <img height="36" width="36" :src="`https://ui-avatars.com/api/?name=${member.name}`" alt="">
                        </figure>

                    </div>
                      <div class="inline-flex gap-x-3">
                      <span v-if="permissions.indexOf('invite_users') !== -1 || permissions.indexOf('*') !== -1" class="">
                          <img class="h-5" src="../../../../public/images/add_user.png" alt="">
                      </span>
                      <a v-if="permissions.indexOf('change_info') !== -1 || permissions.indexOf('*') !== -1" :href="(route('team.settings', {id:team.id}))" class="" >
                          <img class="h-5" src="../../../../public/images/settings.png" alt="">
                      </a>
                    </div>
                 
                </div>
            </div>
        </template>

        <template #side_nav>
            <div class="flex flex-col w-full sticky top-[7em] px-10 gap-y-10 ng-white">
            
              <img class="mx-auto w-44 h-44 rounded-full border-2 border-transparent ring-1" :src="team.avatar" alt="">

            <div>
                <span class=" font-thin text-gray-400">Name</span>
                <h1 class="text-3xl font-extrabold font-serif uppercase">
                   {{team.title}}
                </h1>
            </div>

            <div>
                <span class=" font-thin text-gray-400">Moto</span>
                <p class=" font-sans text-lg text-center text-gray-700">
                    {{team.description}}
                </p>
            </div>

            <button v-if="$page.props.user" @click="sendJoinTeamReq()" class="sticky bottom-5 z-50 py-2 rounded-md text-white font-extrabold bg-sky-600 border-2 border-transparent ring-2"> JOIN </button>
            <a role="button" v-else :href="route('register')" class="sticky bottom-5 z-50 py-2 rounded-md text-white font-extrabold bg-sky-600 border-2 border-transparent ring-2 text-center"> JOIN </a>
            </div>
        </template>

        <section class="flex gap-4 mb-10 mt-3 ">
            <div class="relative w-1/2 h-36 shadow-lg rounded-lg bg-sky-200 overflow-hidden">
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-10 bg-sky-50"></div>
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-14 bg-sky-500 bg-[length:50%] bg-no-repeat bg-right" style="background-image:url('../../../../images/users.svg')"></div>
                <div class="text-white text-xl uppercase font-extrabold absolute w-full h-full flex justify-center items-center">
                    <span class="text-5xl pr-1"> {{team.users.length + 1}} </span> {{ team.users.length > 0 ? 'Users ' : 'USER '}}
                </div>
            </div>

           <div class="relative w-1/2 h-36 shadow-lg rounded-lg bg-sky-200 overflow-hidden">
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-10 bg-sky-50"></div>
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-14 bg-sky-500 bg-[length:50%] bg-no-repeat bg-right" style="background-image:url('../../../../images/project.svg')"></div>
                <div class="text-white text-xl uppercase font-extrabold absolute w-full h-full flex justify-center items-center">
                    <span class="text-5xl pr-1"> {{team.projects.length}}</span> {{team.projects.length > 1 ? 'Projects ' : 'Project '}}
                </div>
            </div>
        </section>

        <div class="">
            <div class="flex justify-between items-center  p-2 sticky top-16 my-10 z-10 bg-gray-100">
                <h4 class="font-bold">Projects </h4>
                <div>
                    <button v-if="permissions.indexOf('create_project') !== -1 || permissions.indexOf('*') !== -1" @click="modalShow = true" type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Create Project</button>
                </div>
            </div>
            <div class="flex flex-col gap-y-4 min-w-full">
                <!-- {{team}} -->
                <div
                    class="bg-white  rounded-xl border shadow-sm p-1 "
                    v-for="project in team.projects" :key="project.id"
                >
                <a :href="route('project.show', {id: team.id, project:project.id})">
                    <span class=" font-thin text-blue-700 text-xs px-4">category name</span>
                    <div class="flex gap-4 border-b pb-5 px-4 ">
                        <div >
                            <h1
                                class="text-md font-bold text-gray-800 first-letter:uppercase"
                            >
                                {{project.title }}
                            </h1>
                            <p class="text-sm text-gray-600 line-clamp-2">
                               {{project.description}}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between pl-2 px-4">
                        <span class="text-sm text-gray-500 py-4"
                            >Updated on jan 10</span
                        >
                        <div class="flex ml-4 pt-3">
                            <span class="h-8 w-8 rounded-full  -ml-3 border-2 border-white  overflow-hidden" v-for="user in project.users" :key="user.id">
                                <img 
                                class=""
                                :src="
                                    `https://ui-avatars.com/api/?name=${user.name}`"
                                alt=""
                                />
            
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </app-layout>
    <Modal v-if="$page.props.user" :show="modalShow" @close="modalShow = false">
           <header class="p-5 border-b">Add New Project</header>
           <div class="p-5">
               
            <Input title="Title" placeholder="type your Project title" v-model="project.title"/>
               <Input title="description" placeholder="type your team description" v-model="project.description"/>
               <label class=" text-red " v-if="gitCheck.error" for="repo">{{gitCheck.message}}</label>
               <Input title="repo" placeholder="type your project repo name" v-model="project.repo"/>
               <button :disabled="gitCheck.is_checking" @click="submit" type="button" class=" float-right my-10 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Save Project</button>

         </div>
    </Modal> 
</template>
<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import Modal from '@/Jetstream/Modal'
import Input from "../../Jetstream/Input.vue";
export default {
    props: ['team', 'permissions'],
    components: { AppLayout, Modal, Input },
    data() {
        return {
            modalShow:false,
            project: {
                title:'',
                description:'',
                team_id:this.team.id,
                repo: ''
            },
            gitCheck: {
                title: 'sfsdf',
              is_checking: false,
              success: false,
              error: false,
              message: null
            }

        }
    },

    methods: {
        submit() {
            this.gitCheck.is_checking = true
            this.checkRepo().then(() => {
            this.gitCheck.is_checking = false
            if (this.gitCheck.error && !this.gitCheck.success) return
            
            this.$inertia.post(route('project.store', {id:this.team.id}), this.project)

        })
            return
        },

        sendJoinTeamReq() {
            this.$inertia.post(route('team.joinRequest', {team:this.team.id}))
        },

        async checkRepo() {
           let self = this
           let data  = null
           const url = 'https://api.github.com/orgs/alxcommunity/repos'
            const config = {
                headers: {
                    Accept: 'application/vnd.github+json',
                    Authorization: 'token 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'
                }
            }

            await axios.get(url, config)
              .then((res) => {
                data = res.data.filter((item) => item.name == self.project.repo.replace(' ', '-'))
             })
              .catch((err) => {
                self.gitCheck.error = true
                self.gitCheck.message = err
                
              });

              if (data.length > 0) {
                    self.gitCheck.error = true
                    self.gitCheck.message = 'duplicated repo name'
                }
                
              else {
                        self.gitCheck.message = 'done'
                        self.gitCheck.success = true
              }
            return;
        }
    }
};
</script>
