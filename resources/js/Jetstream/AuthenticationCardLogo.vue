<template>
    <Link :href="'/'" class="bg-white">
            <img class=" w-48" src="../../../public/images/logo3.png" alt="">

    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
