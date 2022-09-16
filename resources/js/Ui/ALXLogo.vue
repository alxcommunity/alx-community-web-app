<template>
    <div class="max-w-24 max-h-24  flex justify-center">
        <img  class=" w-20 h-20 p-2 bg-slate-600 rounded-2xl" :class="{'p-0 ring-2 border-4 border-gray-100 ': avatar}" :src="avatar ? avatar : `${'../../../images/alxLogo.png'}`" alt="">
    </div>
</template>

<script>
export default {
    props:['avatar']
}
</script>


