<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AOS from 'aos'
import 'aos/dist/aos.css'
import { ref, computed, watch } from 'vue'

AOS.init({
  duration: 600,
  once: true,
})

const props = defineProps({
  products: {
    type: Object,
    default: () => []
  },
  categories: {
    type: Object,
    default: () => []
  },
  selectedCategory: {
    type: String, // slug
    default: ''
  }
})

// state filter
const search = ref('')

// selectedCategory di dropdown (pakai ID biar gampang dibandingkan di product)
const selectedCategory = ref(
  props.selectedCategory
    ? props.categories.find(c => c.slug === props.selectedCategory)?.id.toString()
    : ''
)

// filter logic (hanya untuk pencarian lokal)
const filteredProducts = computed(() => {
  return props.products.filter(p => {
    const matchName = p.name.toLowerCase().includes(search.value.toLowerCase())
    const matchCategory = selectedCategory.value
      ? p.product_category_id === parseInt(selectedCategory.value)
      : true
    return matchName && matchCategory
  })
})

// update URL ketika dropdown kategori berubah
watch(selectedCategory, (val) => {
  const categorySlug = props.categories.find(c => c.id === parseInt(val))?.slug || ''
  router.get('/product', { category: categorySlug }, { preserveState: true, replace: true })
});
</script>


<template>
  <Head title="Product" />
  <GuestLayout>
    <section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen mt-10">
      <div class="container mx-auto px-4">
        <!-- Title -->
        <h2
          class="text-3xl md:text-4xl font-extrabold text-center mb-12 text-gray-800 dark:text-gray-100"
          data-aos="fade-down"
        >
          Daftar Produk
        </h2>

        <!-- Filter -->
        <div
          class="flex flex-col md:flex-row items-center md:items-end justify-between gap-4 mb-12"
          data-aos="fade-up"
        >
          <!-- Search -->
          <div class="w-full md:w-1/2">
            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              Cari Produk
            </label>
            <input
              type="text"
              v-model="search"
              placeholder="Masukkan nama produk..."
              class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100"
            />
          </div>

          <!-- Category -->
          <div class="w-full md:w-1/3">
            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              Pilih Kategori
            </label>
            <select
              v-model="selectedCategory"
              class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100"
            >
              <option value="">Semua Kategori</option>
              <option
                v-for="cat in categories"
                :key="cat.id"
                :value="cat.id"
              >
                {{ cat.name }}
              </option>
            </select>
          </div>
        </div>

        <!-- Product List -->
        <div
          v-if="filteredProducts.length"
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
        >
          <div
            v-for="product in filteredProducts"
            :key="product.id"
            class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition"
            data-aos="zoom-in"
          >
            <!-- Gambar -->
            <div class="h-48 overflow-hidden">
              <img
                :src="product.cover"
                :alt="product.name"
                class="w-full h-full object-cover hover:scale-105 transition-transform"
              />
            </div>

            <!-- Detail -->
            <div class="flex flex-col p-4 h-[220px]">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 line-clamp-1">
                {{ product.name }}
              </h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                {{ product.description }}
              </p>

              <div class="mt-3 flex items-center justify-between">
                <span class="text-blue-600 dark:text-blue-400 font-bold">
                  {{ product.price ? 'Rp ' + product.price.toLocaleString() : 'Hubungi kami' }}
                </span>
                <span
                  class="text-xs px-3 py-1 rounded-full"
                  :class="product.stock > 0 ? 'bg-green-100 text-green-600 dark:bg-green-700 dark:text-green-100' : 'bg-red-100 text-red-600 dark:bg-red-700 dark:text-red-100'"
                >
                  {{ product.stock > 0 ? 'Tersedia' : 'Habis' }}
                </span>
              </div>

              <!-- Tombol -->
              <div class="mt-4 flex gap-3">
                <Link
                  :href="`/product/${product.id}`"
                  class="flex-1 flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                >
                  <i class="fas fa-eye"></i>
                  Detail
                </Link>

                <button
                  class="flex-1 flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition"
                >
                  <i class="fas fa-shopping-cart"></i>
                  Beli
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Jika tidak ada -->
        <div v-else class="text-center text-gray-500 dark:text-gray-400 py-12">
          Tidak ada produk ditemukan.
        </div>
      </div>
    </section>
  </GuestLayout>
</template>
