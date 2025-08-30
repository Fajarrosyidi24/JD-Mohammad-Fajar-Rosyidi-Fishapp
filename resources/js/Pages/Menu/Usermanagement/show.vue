<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { useMenuStore } from '@/Stores/menuStore'
import { ref, onMounted } from 'vue'

const menuStore = useMenuStore()
onMounted(() => {
    menuStore.fetchMenus()
})

const props = defineProps({
    user: Object,
});
const showDeleteModal = ref(false)

const deleteUser = () => {
    router.delete(route('data_karyawan_destroy', { id: props.user.id, role: menuStore.roleName }), {
        onSuccess: () => {
            showDeleteModal.value = false
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
};
</script>

<template>
    <Head title="Detail Karyawan" />
    <AuthenticatedLayout>
        <div class="p-6 max-w-4xl mx-auto space-y-6">
            <!-- Header Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 flex items-center gap-6">
                <div
                    class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <img v-if="user.detail?.profile_photo_url" :src="user.detail.profile_photo_url" alt="Profile Photo"
                        class="w-full h-full object-cover" />
                    <div v-else
                        class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-bold">
                        {{ user.name.charAt(0).toUpperCase() }}
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ user.name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">{{ user.email }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Role: <span class="font-medium text-gray-800 dark:text-gray-200">{{ user.roles[0]?.name ||
                            'Belum ada role' }}</span>
                    </p>
                    <p class="mt-1 text-sm">
                        Status:
                        <span
                            :class="user.email_verified_at ? 'bg-green-100 text-green-800 px-2 py-1 rounded text-xs' : 'bg-red-100 text-red-800 px-2 py-1 rounded text-xs'">
                            {{ user.email_verified_at ? 'Aktif' : 'Belum Aktif' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2 mb-4">
                    Informasi Detail
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Nomor Telepon</p>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">{{ user.detail?.phone || '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Alamat</p>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">{{ user.detail?.address || '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Tanggal Lahir</p>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">{{ user.detail?.birth_date || '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Jenis Kelamin</p>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">{{ user.detail?.gender || '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Foto KTP</p>
                        <div
                            class="mt-1 w-full max-w-md h-48 bg-gray-100 dark:bg-gray-700 rounded overflow-hidden flex items-center justify-center">
                            <img v-if="user.detail?.ktp_url" :src="user.detail.ktp_url" alt="KTP"
                                class="w-full h-full object-cover" />
                            <span v-else class="text-gray-400 text-sm">Belum ada</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <button @click="showDeleteModal = true"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                    Hapus Akun
                </button>

                <Link :href="route('manajemen_pengguna', { role: menuStore.roleName } )"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Kembali
                </Link>
            </div>
        </div>

        <div v-if="showDeleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Konfirmasi Hapus</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Apakah Anda yakin ingin menghapus akun <span class="font-bold">{{ user.name }}</span>?
                </p>
                <div class="mt-6 flex justify-end gap-3">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Batal
                    </button>
                    <button @click="deleteUser"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
