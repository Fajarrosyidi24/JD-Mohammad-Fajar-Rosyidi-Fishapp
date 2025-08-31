<template>
  <div>
    <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center lg:text-left">
      Checkout
    </h2>

    <div class="space-y-4">
      <div
        v-for="item in cartItems"
        :key="item.id"
        class="flex items-center bg-white dark:bg-gray-800 shadow rounded-xl p-3"
      >
        <img :src="item.cover" :alt="item.name" class="w-20 h-20 object-cover rounded-lg" />
        <div class="flex-1 ml-4 text-sm">
          <h3 class="font-semibold text-gray-800 dark:text-gray-100">{{ item.name }}</h3>
          <p class="mt-1 text-gray-800 dark:text-gray-200 font-semibold">Rp {{ formatPrice(item.price) }}</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah: {{ item.quantity }}</p>
        </div>
        <div class="text-right">
          <p class="text-base font-bold text-gray-800 dark:text-gray-100">Rp {{ formatPrice(item.subtotal) }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  cartItems: Array,
});

const formatPrice = (value) => new Intl.NumberFormat("id-ID").format(value);
</script>
