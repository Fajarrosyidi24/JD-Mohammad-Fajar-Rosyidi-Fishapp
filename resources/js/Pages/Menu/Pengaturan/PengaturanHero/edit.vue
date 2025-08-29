<template>

    <Head title="Edit Pengaturan Hero" />

    <AuthenticatedLayout>
        <FlashMessage type="success" />
        <FlashMessage type="error" />
        <div class="p-6 space-y-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Edit Pengaturan Hero
                </h1>
            </div>

            <form @submit.prevent="updateSite"
                class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden p-6 space-y-8">
                <!-- Logo -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Image Hero
                    </label>
                    <input type="file" accept="image/*" @change="handleImageChange"
                        class="w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 focus:ring-2"
                        :class="form.errors.image ? 'border-red-500 focus:ring-red-500' : 'focus:ring-blue-500'" />
                    <InputError :message="form.errors.image" class="mt-1" />
                    <img v-if="previewImage" :src="previewImage" alt="Preview Image"
                        class="w-32 h-32 object-contain rounded-xl shadow mt-3 border" />
                </div>

                <!-- Nama Situs -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Titele Hero
                    </label>
                    <input v-model="form.title" type="text" required
                        class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
                        :class="form.errors.title ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'" />
                    <InputError :message="form.errors.title" class="mt-1" />
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Deskripsi
                    </label>
                    <textarea v-model="form.subtitle" rows="3" required
                        class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
                        :class="form.errors.subtitle ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"></textarea>
                    <InputError :message="form.errors.subtitle" class="mt-1" />
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Buton
                            Text</label>
                        <input v-model="form.button_text" type="text" required
                            class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
                            :class="form.errors.button_text ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'" />
                        <InputError :message="form.errors.button_text" class="mt-1" />
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Youtube
                            url</label>
                        <input v-model="form.youtube_link" type="url" required
                            class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
                            :class="form.errors.youtube_link ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'" />
                        <InputError :message="form.errors.youtube_link" class="mt-1" />
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'
import InputError from '@/Components/InputError.vue'
import FlashMessage from '@/Components/FlashMessage.vue'

const previewImage = ref(null)
const form = useForm({
    title: '',
    subtitle: '',
    button_text: '',
    youtube_link: '',
    image: null
})

const props = defineProps({
    hero: Object,
    role: String
});

onMounted(() => {
    const h = props.hero
    form.title = h.title ?? ''
    form.subtitle = h.subtitle ?? ''
    form.button_text = h.button_text ?? ''
    form.youtube_link = h.youtube_link ?? ''
    previewImage.value = h.image_url ?? null
})

const handleImageChange = (e) => {
    const file = e.target.files[0]
    if (file) {
        form.image = file
        previewImage.value = URL.createObjectURL(file)
        form.clearErrors('image')
    }
}

const updateSite = () => {
    form.post(route('pengaturan_hero_update', { 
        id: props.hero.id, 
        role: props.role 
    }), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>
