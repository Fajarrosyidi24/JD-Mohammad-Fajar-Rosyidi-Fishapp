<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 
               placeholder-gray-400 dark:placeholder-gray-500
               shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
               transition duration-200 ease-in-out
               hover:border-indigo-400 dark:hover:border-indigo-500" v-model="model" ref="input" />
</template>
