<template>
  <div class="flex items-center">
    <div class="relative w-12 h-12 mr-3">
      <img 
        v-if="sitesStore.logoUrl" 
        :src="sitesStore.logoUrl" 
        alt="Logo Situs" 
        class="w-full h-full object-cover rounded-full border-2 border-gray-300 dark:border-gray-600 shadow-md"
      />
    </div>
    <span class="text-2xl font-semibold text-gray-800 dark:text-white truncate">
      {{ sitesStore.siteName || '' }}
    </span>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useSitesStore } from '@/Stores/sitesStore'

const sitesStore = useSitesStore()

onMounted(() => {
  sitesStore.fetchSites()
})
</script>