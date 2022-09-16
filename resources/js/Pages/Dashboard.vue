<template>
    <app-layout title="Dashboard">
            <template v-slot:header>
                <div class="flex justify-evenly">
                <h1 class="text-lg">Dashboard</h1>
                <div class="">
          
                        <Link class="py-3 px-5" href="dashboard/post">Posts</Link>

                        <Link class="py-3 px-5" href="#">Users</Link>

                        <Link class="py-3 px-5" href="#">Teams</Link>

                        <Link class="py-3 px-5" href="#">Projects</Link>

                        <Link class="py-3 px-5" href="#">Roles</Link>
                </div>
                </div>
            </template>
        <div class="flex">
            <div class=" my-20">
                <div class=" bg-black overflow-hidden shadow-xl sm:rounded-lg ">
                    hello
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
        components: {
            AppLayout,
            Head,
            Link
        },
    })
</script>
