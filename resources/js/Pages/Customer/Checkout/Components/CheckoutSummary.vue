<template>
    <div
        class="w-full lg:w-1/3 bg-gradient-to-b from-blue-100 to-blue-300 dark:from-gray-700 dark:to-gray-800 shadow-md rounded-xl p-5 h-fit lg:sticky lg:top-20 text-sm">
        <CourierOptions v-model:selectedCourier="selectedCourier" :district="address?.subdistrict_id"
            @update:selectedCourier="pilihanKurir = $event" />

        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-3">
            Ringkasan Pesanan
        </h3>

        <div class="flex justify-between text-gray-600 dark:text-gray-300 mb-2">
            <span>Total Item</span>
            <span>{{ totalItems }} produk</span>
        </div>

        <div class="flex justify-between text-gray-800 dark:text-gray-200 font-semibold text-base mb-2">
            <span>Total Harga</span>
            <span>Rp {{ formatPrice(totalPrice) }}</span>
        </div>

        <div class="flex justify-between text-gray-800 dark:text-gray-200 font-semibold text-base mb-4">
            <span>Ongkos Kirim</span>
            <span>Rp {{ formatPrice(shippingCost) }}</span>
        </div>

        <!-- Payment Gateway -->
        <div v-if="selectedGateway" class="mb-4">
            <p class="text-gray-700 dark:text-gray-200 font-medium mb-1">Metode Pembayaran</p>
            <div class="flex items-center gap-2 p-3 bg-white dark:bg-gray-700 rounded-lg border shadow-sm">
                <img :src="selectedGateway.image || '/images/seeder/payment-gateway/xendit.png'" alt="logo"
                    class="w-10 h-10 object-contain" />
                <span class="font-semibold text-gray-800 dark:text-gray-100">
                    {{ selectedGateway.name }}
                </span>
            </div>
        </div>

        <!-- Total bayar -->
        <div class="flex justify-between text-gray-800 dark:text-gray-200 font-semibold text-base mb-4">
            <span>Total Bayar</span>
            <span>
                Rp {{ formatPrice(Number(totalPrice) + Number(shippingCost)) }}
            </span>
        </div>

        <button type="button" @click="submitOrder"
            class="w-full py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow transition"
            :disabled="form.processing">
            {{ form.processing ? "Memproses..." : "Buat Pesanan" }}
        </button>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import CourierOptions from "./CourierOptions.vue";

const props = defineProps({
    totalItems: Number,
    address: Object,
    totalPrice: Number,
    selectedGateway: Object,
    cartItems: Array,
});

const formatPrice = (value) => new Intl.NumberFormat("id-ID").format(value);

const selectedCourier = ref(null);
const shippingCost = ref(0);

watch(selectedCourier, (val) => {
    shippingCost.value = val ? val.cost : 0;
});

// === useForm untuk pesanan ===
const form = useForm({
    address_id: null,
    courier: null,
    courier_service: null,
    courier_cost: 0,
    gateway: null,
    cart_items: [],
    total_price: 0,
});

// submit order
function submitOrder() {
    if (!props.address) {
        alert("Pilih alamat terlebih dahulu!");
        return;
    }
    if (!selectedCourier.value) {
        alert("Pilih kurir terlebih dahulu!");
        return;
    }
    if (!props.selectedGateway) {
        alert("Pilih metode pembayaran terlebih dahulu!");
        return;
    }

    form.address_id = props.address.id;
    form.courier = selectedCourier.value.code;
    form.courier_service = selectedCourier.value.service;
    form.courier_cost = shippingCost.value;
    form.gateway = props.selectedGateway.slug;
    form.cart_items = props.cartItems;
    form.total_price = Number(props.totalPrice) + Number(shippingCost.value);

    form.post(route("customer.orders.store"), {
        onSuccess: () => {
            console.log("Pesanan berhasil dibuat");
        },
    });
}
</script>