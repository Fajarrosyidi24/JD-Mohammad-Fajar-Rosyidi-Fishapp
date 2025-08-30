<template>
  <footer class="bg-[#000000] dark:bg-gray-900 text-white pt-12 pb-6 relative">
    <div class="container mx-auto px-4">
      <!-- Grid -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-sm leading-relaxed">

        <div>
          <div class="flex items-center space-x-3">
            <img :src="sites.logo_url" alt="Ijen Transito" class="w-10 h-10">
            <span class="text-lg font-semibold">{{ sites.site_name }}</span>
          </div>
          <p class="mt-4">
            {{ sites.site_description }}
          </p>
          <div class="flex space-x-4 mt-4 text-base">
            <a :href="sites.instagram" target="_blank" class="text-white hover:text-[#fecb3e] transition">
              <i class="bi bi-instagram"></i>
            </a>
            <a :href="sites.tiktok" target="_blank" class="text-white hover:text-[#fecb3e] transition">
              <i class="bi bi-tiktok"></i>
            </a>
            <a :href="sites.youtube" target="_blank" class="text-white hover:text-[#fecb3e] transition">
              <i class="bi bi-youtube"></i>
            </a>
          </div>
        </div>

        <div>
          <h4 class="text-base font-semibold mb-4">Menu</h4>
          <ul class="space-y-2">
            <li>
              <Link :href="route('home', { role: role })" class="text-white hover:text-[#fecb3e]">Beranda</Link>
            </li>
            <li>
              <Link :href="route('product_auth', { role: role })" class="text-white hover:text-[#fecb3e]">Product</Link>
            </li>
          </ul>
        </div>

        <div>
          <h4 class="text-base font-semibold mb-4">Paket Kami</h4>
          <ul class="space-y-2">
            <li>
              <Link :href="route('product_auth', { role: role })" class="text-white hover:text-[#fecb3e]">Daftar Ikan</Link>
            </li>
          </ul>
        </div>


        <!-- <Menu />
        <Service /> -->
        <div>
          <h4 class="text-base font-semibold mb-4">Hubungi Kami</h4>
          <p class="text-white">{{ sites.address }}
          </p>
          <p class="text-white"><strong>Phone:</strong> {{ sites.phone }}</p>
          <p class="text-white"><strong>Email:</strong> {{ sites.email }}</p>
        </div>
      </div>
      <Divider />

    </div>
    <!-- Tombol Scroll Top -->
    <button v-show="showScrollTop" @click="scrollToTop"
      class="fixed bottom-6 right-6 bg-[#fecb3e] text-black p-3 rounded-full shadow-lg hover:bg-yellow-400 transition">
      <i class="bi bi-arrow-up-short text-2xl"></i>
    </button>
  </footer>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Link } from "@inertiajs/vue3";
import Divider from '@/Components/Footer/Divider.vue'

const props = defineProps({
  sites: {
    type: Object,
    default: () => []
  },
  role: {
    type: String,
  },
});

const showScrollTop = ref(false);

const handleScroll = () => {
  showScrollTop.value = window.scrollY > 300;
};

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onBeforeUnmount(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>
