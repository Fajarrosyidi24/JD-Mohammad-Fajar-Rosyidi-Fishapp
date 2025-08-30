<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useMenuStore } from '@/Stores/menuStore'
import { ref, onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'

const menuStore = useMenuStore()
onMounted(() => {
    menuStore.fetchMenus()
})

const props = defineProps({
    user: Array,
    dataroles: Array,
});

const showModal = ref(false);

const form = useForm({
    name: '',
    email: '',
    role: '',
});

// Method untuk submit form
const submitForm = () => {
    form.post(route('karyawan_store', { role: menuStore.getRoleName }), {
        onSuccess: () => {
            showModal.value = false;
            form.reset();
        }
    });
};
</script>

<template>

    <Head title="Data User" />
    <AuthenticatedLayout>
        <div class="p-6 space-y-6">

            <div class="flex justify-end mb-4">
                <button @click="showModal = true"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Create User
                </button>
            </div>

            <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6">
                    <h2 class="text-lg font-semibold mb-4">Tambah User</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" v-model="form.name"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600">
                            <InputError :message="form.errors.name" class="mt-1" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" v-model="form.email"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600">
                            <InputError :message="form.errors.email" class="mt-1" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Role</label>
                            <select v-model="form.role"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600">
                                <option value="">-- Pilih Role --</option>
                                <option v-for="role in dataroles" :key="role.id" :value="role.name">
                                    {{ role.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.role" class="mt-1" />
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-2 mt-4">
                            <button @click="showModal = false" type="button"
                                class="px-3 py-1 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                            <button @click="submitForm" type="button"
                                class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold">Data User</h2>
                </div>
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Jabatan</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Status</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-for="u in user" :key="u.id">
                                <td class="px-4 py-2">{{ u.name }}</td>
                                <td class="px-4 py-2">{{ u.email }}</td>
                                <td class="px-4 py-2">{{ u.roles[0]?.name || 'Belum ada role' }}</td>
                                <td class="px-4 py-2">
                                    <span v-if="u.email_verified_at"
                                        class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Aktif</span>
                                    <span v-else class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Belum
                                        Aktif</span>
                                </td>
                                <td class="px-4 py-2">
                                    <Link :href="route('karyawan.show', { id: u.id, role: menuStore.roleName })"
                                        class="px-3 py-1 text-xs bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow">
                                    Detail
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
