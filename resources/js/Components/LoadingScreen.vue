<template>
  <div
    v-if="loading"
    class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black"
  >
    <img
      :src="sitesStore.settings?.logo_url"
      alt="Loading..."
      class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg animate-bounce"
    />
    <p class="mt-4 text-white font-semibold text-lg">Loading...</p>
  </div>
</template>


<script setup>
import { ref, onMounted } from "vue";
import { useSitesStore } from '@/Stores/sitesStore'

const sitesStore = useSitesStore()

const loading = ref(true);
sitesStore.fetchSites()

onMounted(() => {
  setTimeout(() => {
    loading.value = false;
  }, 1200)
});
</script>
