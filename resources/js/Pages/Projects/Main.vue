<template>
        <div class="flex">
            <div class="basis-9/12" style=" height:calc(100vh - 270px)">
                <Overview :project="project" class="" />
            </div>
            <div class=" basis-1/4 flex flex-col gap-y-10 sticky top-10 text-gray-500">

                <div class="bg-white shadow-lg rounded-md text-sm">
                    <div class="p-3 border-b"> Recent Updates </div>
                    <div class="p-3">
                        <ol class="flex gap-2 flex-col">
                            <li v-for="event in project.events" :key="event.id" class="py-3  px-2 rounded-md">
                                <span class=" font-thin text-xs">Today</span> <br>
                                <div class="bg-gray-50 ">
                                    <a href="#" class="text-sky-500">{{event.user.name}}</a> {{event.description}}
                                </div>
                            </li>


                            <li class="p-3 border-t flex items-center">
                                <span class="mx-auto w-full"> Load More </span>
                            </li>


                        </ol>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>

import Overview from './Partials/Index.vue';

export default ({
    name:"Main",
    props: ['project', 'token', 'permissions'],
    components: {Overview },

    data() {
        return {

        }
    }
})
</script>
