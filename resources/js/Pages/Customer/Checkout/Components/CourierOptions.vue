<template>
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-4">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
      Pilih Opsi Pengiriman
    </h3>

    <!-- Loading -->
    <p v-if="loading" class="text-gray-600 dark:text-gray-300">Mengambil data kurir...</p>

    <!-- Select kurir -->
    <select
      v-else-if="courierOptions.length"
      v-model="selectedOption"
      @change="onSelect"
      class="w-full p-3 border rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"
    >
      <option disabled value="">-- Pilih Kurir --</option>
      <option
        v-for="(option, index) in courierOptions"
        :key="index"
        :value="index"
      >
        {{ option.name }} ({{ option.service }}) - ETD: {{ option.etd || '-' }} - Rp {{ formatPrice(option.cost) }}
      </option>
    </select>

    <!-- Jika belum ada district -->
    <p v-else class="text-gray-500 dark:text-gray-400">
      Silakan pilih alamat/district terlebih dahulu
    </p>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import axios from "axios";

const props = defineProps({
  district: Number,
});

const emits = defineEmits(["update:selectedCourier"]);

const courierOptions = ref([]);
const selectedOption = ref("");
const loading = ref(false);

// format harga Rupiah
const formatPrice = (value) =>
  new Intl.NumberFormat("id-ID").format(value);

// Fetch kurir dari backend
const fetchCouriers = async () => {
  if (!props.district) return; // jaga-jaga biar aman
  loading.value = true;
  try {
    const response = await axios.get("/couriers/active", {
      params: {
        village_id: 31000,
        weight: 1000,
      },
    });
    courierOptions.value = response.data;
  } catch (error) {
    console.error("Gagal mengambil data kurir:", error);
  } finally {
    loading.value = false;
  }
};

// Emit kurir yang dipilih
function onSelect() {
  const selected = courierOptions.value[selectedOption.value];
  emits("update:selectedCourier", selected);
}

// 🔎 Watch district: fetch hanya kalau ada nilai
watch(
  () => props.district,
  (newVal) => {
    if (newVal) {
      fetchCouriers();
    } else {
      courierOptions.value = []; // reset kalau district kosong lagi
      selectedOption.value = "";
    }
  },
  { immediate: true } // jalan langsung kalau district sudah ada sejak awal
);
</script>
