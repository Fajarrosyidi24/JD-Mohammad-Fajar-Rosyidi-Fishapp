<script setup>
import HeaderComponent from '@/Layouts/Customer/HeaderComponent.vue';
import FooterComponent from '@/Layouts/Customer/FooterComponent.vue';
import LoadingScreen from "@/Components/LoadingScreen.vue";
import { useMenuStore } from '@/Stores/menuStore';

import { ref, onMounted } from 'vue';
import axios from 'axios';

const menuStore = useMenuStore()
onMounted(() => {
    menuStore.fetchMenus()
})

// state
const sites = ref(null);
const loading = ref(true);
const error = ref(null);

onMounted(async () => {
  try {
    const response = await axios.get(route('get.site'));
    sites.value = response.data;
  } catch (err) {
    error.value = "Gagal mengambil data situs.";
    console.error("Gagal fetch sites:", err);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <!-- Loading state -->
  <LoadingScreen v-if="loading"/>
  <div v-else>
    <HeaderComponent :sites="sites" :role="menuStore.getRoleName"/>
    <main class="main">
      <slot />
    </main>
    <FooterComponent :sites="sites" :role="menuStore.getRoleName"/>
  </div>
</template>
