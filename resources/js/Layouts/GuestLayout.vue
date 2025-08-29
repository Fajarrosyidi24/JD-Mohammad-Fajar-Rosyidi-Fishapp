<script setup>
import HeaderComponent from '@/Layouts/GuestLayout/HeaderComponent.vue';
import FooterComponent from '@/Layouts/GuestLayout/FooterComponent.vue';
import LoadingScreen from "@/Components/LoadingScreen.vue";

import { ref, onMounted } from 'vue';
import axios from 'axios';

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
    <HeaderComponent :sites="sites" />
    <main class="main">
      <slot />
    </main>
    <FooterComponent :sites="sites" />
  </div>
</template>
