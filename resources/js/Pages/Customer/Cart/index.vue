<template>

    <Head title="Cart" />
    <CustomerLayout>
        <section class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen mt-10">
            <FlashMessage type="success" class="mt-10" />
            <FlashMessage type="error" class="mt-10" />
            <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-6">

                <!-- Daftar produk -->
                <div class="flex-1">
                    <h2
                        class="text-2xl md:text-3xl font-bold mb-4 text-gray-800 dark:text-gray-100 text-center lg:text-left">
                        Cart
                    </h2>

                    <div class="space-y-4">
                        <div v-for="(item, index) in cartItems" :key="item.id"
                            class="flex items-center bg-white dark:bg-gray-800 shadow rounded-xl p-3">
                            <!-- Gambar produk -->
                            <img :src="item.product.cover" :alt="item.product.name"
                                class="w-20 h-20 object-cover rounded-lg" />

                            <!-- Detail produk -->
                            <div class="flex-1 ml-4 text-sm">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                                    {{ item.product.name }}
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                                    {{ item.product.description }}
                                </p>
                                <p class="mt-1 text-gray-800 dark:text-gray-200 font-semibold">
                                    Rp {{ formatPrice(item.price) }}
                                </p>
                            </div>

                            <!-- Kontrol jumlah & subtotal -->
                            <div class="flex flex-col items-end text-sm">
                                <div class="flex items-center space-x-1">
                                    <button @click="decreaseQuantity(index)"
                                        class="px-2 py-0.5 rounded-md bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-sm">
                                        -
                                    </button>
                                    <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded-md">
                                        {{ item.quantity }}
                                    </span>
                                    <button @click="increaseQuantity(index)"
                                        class="px-2 py-0.5 rounded-md bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-sm">
                                        +
                                    </button>
                                </div>
                                <p class="mt-1 text-gray-800 dark:text-gray-200 font-bold">
                                    Rp {{ formatPrice(item.subtotal) }}
                                </p>
                                <button @click="removeItem(item.id, index)"
                                    class="mt-1 text-red-500 hover:underline text-xs">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan belanja -->
                <div
                    class="w-full lg:w-1/3 bg-gradient-to-b from-blue-100 to-blue-300 dark:from-gray-700 dark:to-gray-800 shadow-md rounded-xl p-5 h-fit lg:sticky lg:top-20 text-sm">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-3">
                        Ringkasan Belanja
                    </h3>

                    <div class="flex justify-between text-gray-600 dark:text-gray-300 mb-2">
                        <span>Total Item</span>
                        <span>{{ totalItems }} produk</span>
                    </div>

                    <div class="flex justify-between text-gray-800 dark:text-gray-200 font-semibold text-base mb-4">
                        <span>Total Harga</span>
                        <span>Rp {{ formatPrice(totalPrice) }}</span>
                    </div>

                    <button @click="goToCheckout"
                        class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow">
                        Checkout
                    </button>

                </div>
            </div>
        </section>
    </CustomerLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import { reactive, computed } from "vue";
import { router, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useMenuStore } from '@/Stores/menuStore';
import FlashMessage from "@/Components/FlashMessage.vue";

const menuStore = useMenuStore();
onMounted(() => {
    menuStore.fetchMenus();
});

// Props dari server
const props = defineProps({
    cartItems: {
        type: Array,
        default: () => [],
    },
});

// Membuat cartItems reactive supaya bisa update quantity
const cartItems = reactive(
    props.cartItems.map(item => ({
        ...item,
        subtotal: item.price * item.quantity, // pastikan subtotal awal
    }))
);

// Format harga
const formatPrice = (value) => {
    return new Intl.NumberFormat("id-ID").format(value);
};

// Tambah quantity
const increaseQuantity = (index) => {
    cartItems[index].quantity++;
    updateSubtotal(index);
};

// Kurangi quantity
const decreaseQuantity = (index) => {
    if (cartItems[index].quantity > 1) {
        cartItems[index].quantity--;
        updateSubtotal(index);
    }
};

// Update subtotal item
const updateSubtotal = (index) => {
    cartItems[index].subtotal = cartItems[index].quantity * cartItems[index].price;
};

// Hapus item
const removeItem = (id, index) => {
    if (confirm('Yakin ingin menghapus item ini?')) {
        router.delete(route('cart.destroy', { id: id, role: menuStore.getRoleName }), {
            onSuccess: () => {
                cartItems.splice(index, 1);
            },
            onError: (errors) => {
                console.error(errors);
                alert('Gagal menghapus item');
            }
        });
    }
};

// Total items
const totalItems = computed(() =>
    cartItems.reduce((sum, item) => sum + item.quantity, 0)
);

// Total price
const totalPrice = computed(() =>
    cartItems.reduce((sum, item) => sum + item.subtotal, 0)
);

// Gunakan useForm untuk checkout
const form = useForm({
    cartItems: [],
    totalItems: 0,
    totalPrice: 0
});

const goToCheckout = () => {
    form.cartItems = cartItems.map(item => ({
        id: item.id,
        product_id: item.product.id,
        name: item.product.name,
        cover: item.product.cover,
        price: item.price,
        quantity: item.quantity,
        subtotal: item.subtotal
    }));

    form.totalItems = totalItems.value;
    form.totalPrice = totalPrice.value;

    form.post(route('checkout.store', {role:menuStore.getRoleName}), {
        onSuccess: () => {
            console.log('Checkout data dikirim');
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
};
</script>

