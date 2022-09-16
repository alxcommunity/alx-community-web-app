<template>
        <main class="mb-10">
            <div class="flex gap-x-3 overflow-auto">
                <div class="  w-48 min-w-[300px] bg-sky-200 bg-opacity-10 border rounded-md p-2"
                    v-for="board in project.boards" :key="board.id">
                    <div class="w-full bg-white font-bold pl-4 py-4 mb-7 rounded-md"> {{board.title}}
                        <span v-if="permissions.indexOf('create_task') !== -1 || permissions.indexOf('*') !== -1"
                            class=" cursor-pointer hover:bg-gradient-to-tr to-slate-600 float-right pr-5 text-xl font-extrabold"
                            @click="initNewTask(board.id, $event)">+</span>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <div class=" rounded-md pt-5 gap-y-4 bg-white" v-for="task in board.tasks" :key="task.id">
                            <span
                                class="ml-4 border rounded-3xl font-bold bg-yellow-200 text-blue-700 text-xs px-4 py-1 mb-1">Desgin</span>
                            <div class="flex gap-4 border-b pb-5 px-4 pt-2">
                                <div>
                                    <h1 class="text-md font-bold text-gray-800 first-letter:uppercase">
                                        {{ task.title }}
                                    </h1>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ task.description}}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between pl-2 px-4">
                                <span class="text-sm text-gray-500 py-4">{{task.created_at}}</span>
                                <div class="flex ml-4 pt-3">
                                    <img class="h-8 rounded-full border border-gray-50 " :src="`
                                        https://ui-avatars.com/api/?name=${task.user.name}`" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    <Modal v-if="permissions.indexOf('create_board') !== -1 || permissions.indexOf('*') !== -1" :show="showModal || localModal"
        @close="showModal = false; newTask = false; localModal = false; $emit('closeModal')">
        <header class="p-5 border-b">
            <p v-if="newTask"> Add New Project </p>
            <p v-else> Add New Board </p>
        </header>
        <div v-if="newTask" class="p-5">
            <Input title="Title" placeholder="type your title" v-model="task.title" />
            <Input title="description" placeholder="type your description" v-model="task.description" />
            <Input title="category" placeholder="select your category" v-model="task.category" />
            <button type="button" @click="createTask"
                class=" float-right my-10 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Save
                task</button>

        </div>
        <div v-else class="p-5">
            <Input title="Title" placeholder="type your Project title" v-model="board.title" />
            <button type="button" @click="createBoard"
                class=" float-right my-10 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Save
                board</button>

        </div>
    </Modal>
</template>

<script>

import Modal from '@/Jetstream/Modal'
import Input from '../../Jetstream/Input.vue';
export default ({
    props: ['project', 'permissions', 'showModal'],
    components: { Modal, Input },

    data() {
        return {
            localModal: false,
            newTask: false,
            board: {
                title: '',
                project_id: this.project.id
            },
            task: {
                title: '',
                discription: '',
                category: '',
                board_id: ''
            }
        }
    },
    methods: {
        initNewTask(id) {
            this.task.board_id = id;
             this.newTask = true
             this.localModal = true
        },
        createBoard() {
             this.$inertia.post(route('board.store'), this.board, {
                onSuccess: () => {
                    this.reset()
                }
             })
         },
         createTask() {
             this.$inertia.post(route('task.store'), this.task, {
                onSuccess: () => {
                    this.reset()
                }
             })
         },

         reset() {
            this.$emit('closeModal')
            this.localModal = false
            this.newTask = false
            this.board.title = ""
            this.task = {
                title: '',
                discription: '',
                category: '',
                board_id: ''
            }
         }
    }
})
</script>