<template>
  <div>
    <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Alamat Pengiriman</h3>

    <div v-if="addresses.length">
      <select
        v-model="selectedAddressId"
        @change="onSelectAddress"
        class="w-full mb-3 p-2 rounded border dark:bg-gray-700 dark:text-gray-100"
      >
        <option value="" disabled>Pilih alamat pengiriman</option>
        <option v-for="address in addresses" :key="address.id" :value="address.id">
          {{ address.full_name }} – {{ address.address }}
        </option>
      </select>

      <!-- Optional: tampilkan detail alamat yang dipilih -->
      <div v-if="selectedAddress" class="bg-white dark:bg-gray-800 shadow rounded-xl p-4 mb-3">
        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ selectedAddress.full_name }}</p>
        <p class="text-gray-600 dark:text-gray-300 text-sm">
          {{ selectedAddress.address }}, {{ selectedAddress.city }}, {{ selectedAddress.state }}
        </p>
        <p class="text-gray-600 dark:text-gray-300 text-sm">
          {{ selectedAddress.country }} – {{ selectedAddress.zip_code }}
        </p>
        <p class="text-gray-600 dark:text-gray-300 text-sm">
          Telp: {{ selectedAddress.country_code }} {{ selectedAddress.phone }}
        </p>
      </div>
    </div>

    <div v-else class="text-gray-600 dark:text-gray-300 italic mb-3">
      Belum ada alamat pengiriman, silakan tambahkan.
    </div>

    <button
      type="button"
      @click="$emit('update:showModal', true)"
      class="mt-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow transition"
    >
      + Tambah Alamat
    </button>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
  addresses: Array,
  role: String,
});

// deklarasi emit
const emit = defineEmits(["update:showModal", "update:selectedAddress"]);

// selected address id
const selectedAddressId = ref(null);

// ambil data address lengkap dari id yang dipilih
const selectedAddress = computed(() => {
  return props.addresses.find(addr => addr.id === selectedAddressId.value) || null;
});

// emit ke parent kalau ada perubahan
const onSelectAddress = () => {
  emit("update:selectedAddress", selectedAddress.value);
};
</script>