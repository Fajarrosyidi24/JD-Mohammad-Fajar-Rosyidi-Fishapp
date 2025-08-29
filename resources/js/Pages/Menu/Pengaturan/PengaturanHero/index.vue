<template>

    <Head title="Pengaturan Hero" />

    <AuthenticatedLayout>
        <FlashMessage type="success" />
        <FlashMessage type="error" />

        <div class="p-6 space-y-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Pengaturan Hero
                </h1>
                <Link v-if="hero && menuStore.roleName"
                    :href="route('pengaturan_hero_edit', { id: hero.id, role: menuStore.roleName })"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                <i class="fas fa-edit mr-2"></i> Edit
                </Link>
            </div>
            <!-- Card Container -->
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

                <!-- Header -->
                <div class="flex flex-col md:flex-row items-center gap-6 p-6 border-b dark:border-gray-700">
                    <img :src="hero.image_url" alt="Hero"
                        class="w-32 h-32 object-cover rounded-xl shadow-md ring-4 ring-gray-200 dark:ring-gray-700 cursor-pointer hover:scale-105 transition"
                        @click="openModal(hero.image_url)" />
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                            {{ hero.title }}
                        </h1>
                        <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                            {{ hero.subtitle }}
                        </p>
                    </div>
                </div>

                <!-- Detail Section -->
                <div class="p-6 grid md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                            Informasi Button
                        </h2>
                        <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                            <li class="flex items-center gap-3">
                                <i class="fab fa-youtube text-red-500 text-lg"></i>
                                <a :href="hero.youtube_link" target="_blank"
                                    class="hover:underline text-blue-600 dark:text-blue-400">
                                    {{ hero.youtube_link }}
                                </a>
                            </li>

                            <li class="flex items-center gap-3">
                                <i class="fas fa-hand-pointer text-green-500 text-lg"></i>
                                <span class="font-medium">
                                    {{ hero.button_text }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <transition name="fade-scale" appear>
            <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>
                <div class="relative z-50 p-4">
                    <img :src="currentImage" class="w-96 h-96 object-contain rounded-lg shadow-lg" />
                    <button @click="closeModal"
                        class="absolute top-2 right-2 text-white text-2xl font-bold">&times;</button>
                </div>
            </div>
        </transition>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import FlashMessage from '@/Components/FlashMessage.vue'
import { useMenuStore } from '@/Stores/menuStore'
import { onMounted, ref } from 'vue'

const menuStore = useMenuStore()

onMounted(() => {
    menuStore.fetchMenus()
})

const showModal = ref(false)
const currentImage = ref(null)

function openModal(src) {
    currentImage.value = src
    showModal.value = true
}

function closeModal() {
    showModal.value = false
    currentImage.value = null
}

const props = defineProps({
    hero: Object
});
</script>

<style>
.fade-scale-enter-active,
.fade-scale-leave-active {
    transition: all 0.3s ease;
}

.fade-scale-enter-from,
.fade-scale-leave-to {
    opacity: 0;
    transform: scale(0.9);
}
</style>