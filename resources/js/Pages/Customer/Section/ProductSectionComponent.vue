<template>
  <section
    id="product"
    class="product section py-16 bg-gray-50 dark:bg-gray-900"
  >
    <div class="container mx-auto px-4">
      <!-- Judul -->
      <h2
        class="text-3xl md:text-4xl font-extrabold text-center mb-12 text-gray-800 dark:text-gray-100"
      >
        Produk Kami
      </h2>

      <div
        class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
      >
        <div
          v-for="product in products.slice(0, 4)"
          :key="product.id"
          class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300 overflow-hidden flex flex-col"
        >
          <!-- Gambar produk -->
          <div class="w-full aspect-[4/3] overflow-hidden">
            <img
              :src="product.cover"
              :alt="product.name"
              class="w-full h-full object-cover transform hover:scale-105 transition duration-500"
            />
          </div>

          <!-- Detail produk -->
          <div class="p-5 flex flex-col flex-grow">
            <h3
              class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2 line-clamp-1"
            >
              {{ product.name }}
            </h3>

            <!-- Harga -->
            <p
              class="text-xl font-bold text-blue-600 dark:text-blue-400 mb-2"
            >
              {{ product.price ? 'Rp ' + product.price.toLocaleString() : 'Hubungi kami' }}
            </p>

            <!-- Stock -->
            <p
              class="text-sm font-medium text-green-600 dark:text-green-400 mb-3"
            >
              Stok: {{ product.stock ?? 'Tidak tersedia' }}
            </p>

            <!-- Deskripsi -->
            <p
              class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3"
            >
              {{ product.description ?? 'Produk segar pilihan terbaik untuk Anda.' }}
            </p>

            <!-- Tombol aksi -->
            <div class="mt-auto flex gap-3">
              <!-- Tombol Detail -->
              <Link
                :href="`/product/${product.id}`"
                class="flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition w-full"
              >
                <i class="fas fa-eye"></i>
                Detail
              </Link>

              <!-- Tombol Beli -->
              <button
                class="flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition w-full"
              >
                <i class="fas fa-shopping-cart"></i>
                Beli
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol Selengkapnya -->
      <div class="text-center mt-10">
        <Link
          :href="route('product_auth', { role: role })"
          class="inline-block px-6 py-3 rounded-xl text-base font-medium bg-gray-800 text-white hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 transition"
        >
          Selengkapnya
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  products: {
    type: Array,
    default: () => [],
  },
  role: {
    type: String,
  }
});
</script>
