<template>
  
    <input :title="title" class="w-full p-1 px-3 my-3 mb-8 border-0 border-b shadow-none focus:shadow-none  focus:border-b focus:border-sky-500   focus:ring-0" :placeholder="placeholder"  :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    import { defineComponent } from 'vue'
 
    export default defineComponent({
        props: ['modelValue', 'title', 'placeholder'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    })
</script>
