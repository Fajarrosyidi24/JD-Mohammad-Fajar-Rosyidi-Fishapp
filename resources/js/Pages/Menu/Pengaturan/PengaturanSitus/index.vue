<template>
  <Head title="Pengaturan Situs" />

  <AuthenticatedLayout>
    <!-- Flash Messages -->
    <FlashMessage type="success" />
    <FlashMessage type="error" />

    <div class="p-6 space-y-6">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
          Pengaturan Situs
        </h1>

        <Link v-if="sitesStore.settings && menuStore.roleName"
          :href="route('pengaturan_situs_edit', { id: sitesStore.settings.id, role: menuStore.roleName })"
          class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
          <i class="fas fa-edit mr-2"></i> Edit
        </Link>

      </div>

      <!-- Loading / Error -->
      <div v-if="sitesStore.loading" class="text-center text-gray-500">
        Memuat data...
      </div>
      <div v-else-if="sitesStore.error" class="text-center text-red-500">
        {{ sitesStore.error }}
      </div>

      <!-- Content -->
      <div v-else-if="sitesStore.settings"
        class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

        <!-- Logo & Title -->
        <div class="flex flex-col md:flex-row items-center gap-6 p-6 border-b dark:border-gray-700">
          <img 
            v-if="sitesStore.logoUrl" 
            :src="sitesStore.logoUrl" 
            alt="Logo"
            class="w-32 h-32 object-cover rounded-full shadow cursor-pointer"
            @click="openModal(sitesStore.logoUrl)"
          />
          <div class="text-center md:text-left">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
              {{ sitesStore.siteName }}
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
              {{ sitesStore.settings.site_description }}
            </p>
          </div>
        </div>

        <!-- Kontak & Address -->
        <div class="p-6 grid md:grid-cols-2 gap-6">
          <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">
              Kontak
            </h2>
            <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
              <li class="flex items-center">
                <i class="fas fa-phone-alt text-blue-500 w-6"></i>
                <span>{{ sitesStore.settings.phone }}</span>
              </li>
              <li class="flex items-center">
                <i class="fas fa-envelope text-green-500 w-6"></i>
                <span>{{ sitesStore.settings.email }}</span>
              </li>
              <li class="flex items-center">
                <i class="fas fa-map-marker-alt text-red-500 w-6"></i>
                <span>{{ sitesStore.settings.address }}</span>
              </li>
            </ul>
          </div>

          <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">
              Media Sosial
            </h2>
            <div class="flex gap-6 text-2xl">
              <a :href="sitesStore.settings.instagram" target="_blank" class="text-pink-500 hover:text-pink-600 transition">
                <i class="fab fa-instagram"></i>
              </a>
              <a :href="sitesStore.settings.tiktok" target="_blank" class="text-gray-900 dark:text-white hover:text-gray-600 transition">
                <i class="fab fa-tiktok"></i>
              </a>
              <a :href="sitesStore.settings.youtube" target="_blank" class="text-red-600 hover:text-red-700 transition">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Preview (Small Fixed Size) -->
    <transition name="fade-scale" appear>
      <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>
        <div class="relative z-50 p-4">
          <img 
            :src="currentImage" 
            class="w-96 h-96 object-contain rounded-lg shadow-lg" 
          />
          <button 
            @click="closeModal" 
            class="absolute top-2 right-2 text-white text-2xl font-bold"
          >&times;</button>
        </div>
      </div>
    </transition>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { useSitesStore } from '@/Stores/sitesStore'
import { useMenuStore } from '@/Stores/menuStore'
import { onMounted, ref } from 'vue'
import FlashMessage from '@/Components/FlashMessage.vue'

const sitesStore = useSitesStore()
const menuStore = useMenuStore()

// Modal state
const showModal = ref(false)
const currentImage = ref(null)

function openModal(src) {
  currentImage.value = src
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  currentImage.value = null
}

onMounted(() => {
  sitesStore.fetchSites()
  menuStore.fetchMenus()
})
</script>

<style>
/* Animasi modal */
.fade-scale-enter-active, .fade-scale-leave-active {
  transition: all 0.3s ease;
}
.fade-scale-enter-from, .fade-scale-leave-to {
  opacity: 0;
  transform: scale(0.9);
}
</style>
