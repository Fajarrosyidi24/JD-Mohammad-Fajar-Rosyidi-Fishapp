<template>

    <Head :title="product.name" />
    <CustomerLayout>
        <FlashMessage type="success" class="mt-10"/>
        <FlashMessage type="error" class="mt-10"/>
        <section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen mt-10">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8"
                    data-aos="fade-up">
                    <!-- Left: Product Image -->
                    <div class="flex flex-col items-center">
                        <div
                            class="w-[280px] h-[280px] rounded-xl overflow-hidden shadow-md border border-gray-200 dark:border-gray-700">
                            <img :src="product.cover" :alt="product.name" class="w-full h-full object-cover" />
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2 justify-center">
                            <span class="px-3 py-1 text-sm font-medium bg-orange-100 text-orange-600 rounded-full">
                                {{ product.category?.name }}
                            </span>
                            <span class="px-3 py-1 text-sm font-medium bg-emerald-100 text-emerald-600 rounded-full">
                                Stok: {{ product.stock }} KG
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">
                                {{ product.name }}
                            </h2>
                            <p class="text-base md:text-lg text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                {{ product.description }}
                            </p>

                            <p class="text-2xl font-extrabold text-orange-500 mb-6">
                                Rp {{ Number(product.price).toLocaleString("id-ID") }} / KG
                            </p>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">
                                    Penjual
                                </h3>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden shadow-sm">
                                        <i v-if="!product.user?.detail?.profile_photo_url"
                                            class="fas fa-user text-lg text-gray-500"></i>
                                        <img v-else :src="product.user.detail.profile_photo_url" alt="Profile"
                                            class="w-full h-full object-cover" />
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ product.user?.name }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ product.user?.detail?.phone }} •
                                            {{ product.user?.detail?.address }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity & Subtotal -->
                        <div class="mt-6 space-y-4">
                            <!-- Kuantitas -->
                            <div class="flex items-center gap-3">
                                <span class="font-medium text-gray-700 dark:text-gray-300">Jumlah:</span>
                                <div
                                    class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                    <button @click="decreaseQuantity"
                                        class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300">
                                        -
                                    </button>
                                    <input type="number" v-model="quantity" min="1" :max="product.stock"
                                        class="w-16 text-center border-x border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none" />
                                    <button @click="increaseQuantity"
                                        class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300">
                                        +
                                    </button>
                                </div>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">KG</span>
                            </div>

                            <!-- Subtotal -->
                            <div>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    Subtotal:
                                    <span class="text-orange-500 font-bold">
                                        Rp {{ subtotal.toLocaleString("id-ID") }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="mt-8 flex gap-4">
                            <button @click="addToCart(subtotal, quantity)"
                                class="flex-1 py-3 bg-primary text-white font-semibold rounded-xl shadow-md transition duration-200">
                                Tambah ke Keranjang
                            </button>
                            <button
                                class="flex-1 py-3 border border-primary text-primary hover:bg-primary/10 dark:hover:bg-gray-700 font-semibold rounded-xl transition duration-200">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </CustomerLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import FlashMessage from '@/Components/FlashMessage.vue'
import AOS from "aos";
import "aos/dist/aos.css";
import { ref, computed } from "vue";
import { router } from '@inertiajs/vue3';

const addToCart = (subtotal, quantity) => {
    try {
        router.post(route('add_cart', { role: props.role, id: props.product.id, quantity: quantity, subtotal: subtotal }));
    } catch (error) {
        console.error('Add to cart failed', error);
    }
};

AOS.init({
    duration: 600,
    once: true,
});

const props = defineProps({
    product: {
        type: Object,
        default: () => ({}),
    },
    role: {
        type: String,
    },
});

const quantity = ref(1);

const increaseQuantity = () => {
    if (quantity.value < props.product.stock) {
        quantity.value++;
    }
};
const decreaseQuantity = () => {
    if (quantity.value > 1) {
        quantity.value--;
    }
};

// Subtotal otomatis
const subtotal = computed(() => {
    return quantity.value * (props.product.price ?? 0);
});
</script>
