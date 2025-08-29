<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue'

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>

    <Head title="Profil" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                Profil Saya
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-4xl space-y-8 sm:px-6 lg:px-8">

                <!-- Update Profile -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8 transition-all duration-200 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">
                        Informasi Profil
                    </h3>
                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status"
                        class="max-w-xl" />
                    <FlashMessage type="success" />
                    <FlashMessage type="error" />
                </div>

                <!-- Update Password -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8 transition-all duration-200 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">
                        Ganti Kata Sandi
                    </h3>
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <!-- Delete Account -->
                <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8 transition-all duration-200 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">
                        Hapus Akun
                    </h3>
                    <DeleteUserForm class="max-w-xl" />
                </div> -->

            </div>
        </div>
    </AuthenticatedLayout>
</template>
