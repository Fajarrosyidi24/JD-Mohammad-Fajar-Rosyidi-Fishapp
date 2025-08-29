<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Dummy data untuk pesanan terbaru
const recentOrders = [
  { id: 1, customer: "Budi Santoso", trip: "Trip Bromo Sunrise", date: "2025-08-10", status: "Selesai" },
  { id: 2, customer: "Siti Aminah", trip: "Trip Ijen Blue Fire", date: "2025-08-12", status: "Dalam Proses" },
  { id: 3, customer: "Andi Wijaya", trip: "Trip Bali 3 Hari", date: "2025-08-13", status: "Dibatalkan" },
  { id: 4, customer: "Dewi Lestari", trip: "Trip Karimunjawa", date: "2025-08-14", status: "Selesai" },
];

// Dummy statistik
const stats = [
  { title: "Total Pesanan", value: 120 },
  { title: "Pelanggan Baru", value: 35 },
  { title: "Trip Berjalan", value: 8 },
  { title: "Pendapatan Bulan Ini", value: "Rp 45.000.000" },
];
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="p-6 space-y-6">
      
      <!-- Statistik -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div v-for="(item, index) in stats" :key="index" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
          <h3 class="text-gray-500 text-sm">{{ item.title }}</h3>
          <p class="text-2xl font-bold">{{ item.value }}</p>
        </div>
      </div>

      <!-- Pesanan Terbaru -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold">Pesanan Terbaru</h2>
        </div>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th class="px-4 py-2 text-left text-sm font-semibold">Customer</th>
              <th class="px-4 py-2 text-left text-sm font-semibold">Trip</th>
              <th class="px-4 py-2 text-left text-sm font-semibold">Tanggal</th>
              <th class="px-4 py-2 text-left text-sm font-semibold">Status</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="order in recentOrders" :key="order.id">
              <td class="px-4 py-2">{{ order.customer }}</td>
              <td class="px-4 py-2">{{ order.trip }}</td>
              <td class="px-4 py-2">{{ order.date }}</td>
              <td class="px-4 py-2">
                <span 
                  :class="{
                    'bg-green-100 text-green-800 px-2 py-1 rounded text-xs': order.status === 'Selesai',
                    'bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs': order.status === 'Dalam Proses',
                    'bg-red-100 text-red-800 px-2 py-1 rounded text-xs': order.status === 'Dibatalkan'
                  }"
                >
                  {{ order.status }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </AuthenticatedLayout>
</template>
