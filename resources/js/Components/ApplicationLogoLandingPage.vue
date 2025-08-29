<template>
  <div class="flex items-center gap-2">
    <!-- Logo wrapper -->
    <div class="relative w-12 h-12 flex-shrink-0 overflow-hidden rounded-full border-2 border-gray-300 shadow-md mt-2 mb-2">
      <img 
        v-if="sitesStore.logoUrl" 
        :src="sitesStore.logoUrl" 
        alt="Logo Situs" 
        class="w-full h-full object-cover"
      />
    </div>
    <!-- Nama situs -->
    <h1 class="text-2xl font-semibold logo-color truncate">
      {{ sitesStore.siteName || '' }}
    </h1>
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

<style>
.logo-color {
  color: var(--accent-color);
  transition: color 0.3s ease;
}

.logo-color:hover {
  color: #ffffff;
}

</style>

