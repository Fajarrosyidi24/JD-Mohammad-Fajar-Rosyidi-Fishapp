<script setup>
defineProps({
    value: {
        type: String,
        default: '',
    },
    size: {
        type: String,
        default: 'sm', // opsi: sm, md, lg
    },
});
</script>

<template>
    <label
        class="font-medium text-gray-700 dark:text-gray-300"
        :class="{
            'text-sm': size === 'sm',
            'text-base': size === 'md',
            'text-lg': size === 'lg',
        }"
    >
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
