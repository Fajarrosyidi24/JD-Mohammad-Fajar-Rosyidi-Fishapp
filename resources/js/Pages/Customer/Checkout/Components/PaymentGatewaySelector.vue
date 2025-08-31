<template>
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-6">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
      Pilih Metode Pembayaran
    </h3>

    <div class="grid gap-4 md:grid-cols-2">
      <div
        v-for="gateway in gateways"
        :key="gateway.id"
        @click="selectGateway(gateway)"
        class="flex items-center gap-4 p-4 border rounded-xl cursor-pointer transition-all duration-200"
        :class="[
          selectedGateway?.id === gateway.id
            ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/40'
            : 'border-gray-300 dark:border-gray-600 hover:border-blue-400'
        ]"
      >
        <!-- Logo -->
        <img
          :src="gateway.image || '/images/seeder/payment-gateway/xendit.png'"
          alt="logo"
          class="w-12 h-12 object-contain"
        />

        <!-- Info -->
        <div class="flex-1">
          <p class="font-semibold text-gray-800 dark:text-gray-100">
            {{ gateway.name }}
          </p>
          <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ gateway.slug }}
          </p>
        </div>

        <!-- Check icon -->
        <svg
          v-if="selectedGateway?.id === gateway.id"
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 h-6 text-blue-600"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
  gateways: {
    type: Array,
    default: () => [],
  },
});

const emits = defineEmits(["update:selectedGateway"]);

const selectedGateway = ref(null);

function selectGateway(gateway) {
  selectedGateway.value = gateway;
  emits("update:selectedGateway", gateway);
}
</script>
