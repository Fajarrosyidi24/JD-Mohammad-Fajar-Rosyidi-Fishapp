<template>
  <section id="categories" class="py-10 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
      <!-- Judul -->
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-8 text-gray-800 dark:text-gray-100">
        Kategori
      </h2>

      <!-- Grid kategori -->
      <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
        <Link v-for="category in categories" :key="category.id" :href="`/product?category=${category.slug}`"
          class="flex flex-col items-center bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition p-3">
        <!-- Gambar kategori -->
        <div class="w-16 h-16 rounded-full overflow-hidden mb-2">
          <img :src="category.cover" :alt="category.name" class="w-full h-full object-cover" />
        </div>

        <!-- Nama kategori -->
        <span class="text-sm font-medium text-gray-700 dark:text-gray-200 text-center truncate w-full">
          {{ category.name }}
        </span>
        </Link>

      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
});
</script>
