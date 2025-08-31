<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps({
  invoiceUrl: String
})

const loading = ref(true)

onMounted(() => {
  setTimeout(() => {
    window.location.href = props.invoiceUrl
  }, 2000)
});
</script>

<template>
  <div class="flex flex-col items-center justify-center h-screen">
    <div v-if="loading" class="text-center">
      <svg class="animate-spin h-10 w-10 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
      </svg>
      <p class="text-lg font-semibold">Mengalihkan ke halaman pembayaran...</p>
    </div>
  </div>
</template>
