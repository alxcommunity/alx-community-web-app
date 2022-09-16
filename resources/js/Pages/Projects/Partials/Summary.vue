<template>
    <div class="">
                        
        <div class="p-5 px-9">
            <ul>
                <li class="flex pt-1 text-gray-600 first-letter:uppercase text-base"> <p class=" basis-1/3"> Created By  </p>  <a href="#">fitsum belay</a></li>
                <li class="flex pt-1 text-gray-600 first-letter:uppercase text-base"> <p class=" basis-1/3">Created At</p>  <p>3 months ago</p>  </li>
                <li class="flex pt-1 text-gray-600 first-letter:uppercase text-base"> <p class=" basis-1/3">Status</p>  <p> in progress </p></li>
            </ul>
        </div>

        <div class="inline-flex mx-2 gap-x-14 justify-center w-full border-b   font-extrabold font-sans">
           <Button @click="tab = 'info'" class="py-2 px-4" :class="{'border-b border-sky-600':tab == 'info'}"> Info </Button>
            <Button @click="tab = 'chat'" class="py-2 px-4" :class="{'border-b border-sky-600':tab == 'chat'}"> Chat </Button>
            <Button @click="tab = 'more'" class="py-2 px-4"> More </Button>
        </div>
    </div>
    <div class="h-full">
        <Info v-if="tab == 'info'"/>
        <Chat v-else-if="tab == 'chat'"/>
        <More v-else-if="tab == 'more'"/>

    </div>
</template>

<script>
import Chat from './Chat.vue'
import Info  from './Info.vue'
import More  from './More.vue'
export default( {
    components: {Chat, Info, More},

    data() {
        return {
            tab:'chat'
        }
    }
})
</script>