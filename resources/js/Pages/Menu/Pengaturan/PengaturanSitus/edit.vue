<template>
  <Head title="Edit Pengaturan Situs" />

  <AuthenticatedLayout>
    <FlashMessage type="success" />
    <FlashMessage type="error" />
    <div class="p-6 space-y-6">
      <!-- Judul Halaman -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
          Edit Pengaturan Situs
        </h1>
      </div>

      <!-- Loader & Error -->
      <div v-if="sitesStore.loading" class="text-center text-gray-500">
        Memuat data...
      </div>
      <div v-else-if="sitesStore.error" class="text-center text-red-500">
        {{ sitesStore.error }}
      </div>

      <!-- Form -->
      <form
        v-else
        @submit.prevent="updateSite"
        class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden p-6 space-y-8"
      >
        <!-- Logo -->
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
            Logo
          </label>
          <input
            type="file"
            accept="image/*"
            @change="handleLogoChange"
            class="w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 focus:ring-2"
            :class="form.errors.logo ? 'border-red-500 focus:ring-red-500' : 'focus:ring-blue-500'"
          />
          <InputError :message="form.errors.logo" class="mt-1" />
          <img
            v-if="previewLogo"
            :src="previewLogo"
            alt="Preview Logo"
            class="w-32 h-32 object-contain rounded-xl shadow mt-3 border"
          />
        </div>

        <!-- Nama Situs -->
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
            Nama Situs
          </label>
          <input
            v-model="form.site_name"
            type="text"
            required
            class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
            :class="form.errors.site_name ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
          />
          <InputError :message="form.errors.site_name" class="mt-1" />
        </div>

        <!-- Deskripsi -->
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
            Deskripsi
          </label>
          <textarea
            v-model="form.site_description"
            rows="3"
            required
            class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
            :class="form.errors.site_description ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
          ></textarea>
          <InputError :message="form.errors.site_description" class="mt-1" />
        </div>

        <!-- Kontak -->
        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
              No. Telepon
            </label>
            <input
              v-model="form.phone"
              type="text"
              class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
              :class="form.errors.phone ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
            />
            <InputError :message="form.errors.phone" class="mt-1" />
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
              Email
            </label>
            <input
              v-model="form.email"
              type="email"
              required
              class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
              :class="form.errors.email ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
            />
            <InputError :message="form.errors.email" class="mt-1" />
          </div>
          <div class="md:col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
              Alamat
            </label>
            <input
              v-model="form.address"
              type="text"
              required
              class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
              :class="form.errors.address ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
            />
            <InputError :message="form.errors.address" class="mt-1" />
          </div>
        </div>

        <!-- Media Sosial -->
        <div class="grid md:grid-cols-3 gap-6">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Instagram</label>
            <input
              v-model="form.instagram"
              type="url"
              required
              class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
              :class="form.errors.instagram ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
            />
            <InputError :message="form.errors.instagram" class="mt-1" />
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Tiktok</label>
            <input
              v-model="form.tiktok"
              type="url"
              required
              class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
              :class="form.errors.tiktok ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
            />
            <InputError :message="form.errors.tiktok" class="mt-1" />
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Youtube</label>
            <input
              v-model="form.youtube"
              type="url"
              required
              class="w-full rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2"
              :class="form.errors.youtube ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
            />
            <InputError :message="form.errors.youtube" class="mt-1" />
          </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition"
          >
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
import { useSitesStore } from '@/Stores/sitesStore'
import { onMounted, ref } from 'vue'
import { useMenuStore } from '@/Stores/menuStore'
import InputError from '@/Components/InputError.vue'
import FlashMessage from '@/Components/FlashMessage.vue'

// Stores
const sitesStore = useSitesStore()
const menuStore = useMenuStore()

// Preview logo
const previewLogo = ref(null)

// useForm agar gampang tangani errors
const form = useForm({
  site_name: '',
  site_description: '',
  phone: '',
  email: '',
  address: '',
  instagram: '',
  tiktok: '',
  youtube: '',
  logo: null
})

// Load data awal
onMounted(async () => {
  menuStore.fetchMenus()
  await sitesStore.fetchSites()
  if (sitesStore.settings) {
    const s = sitesStore.settings
    form.site_name = s.site_name ?? ''
    form.site_description = s.site_description ?? ''
    form.phone = s.phone ?? ''
    form.email = s.email ?? ''
    form.address = s.address ?? ''
    form.instagram = s.instagram ?? ''
    form.tiktok = s.tiktok ?? ''
    form.youtube = s.youtube ?? ''
    previewLogo.value = sitesStore.logoUrl ?? null
  }
})

// Handle ganti logo (preview realtime)
const handleLogoChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    form.logo = file
    previewLogo.value = URL.createObjectURL(file)
    form.clearErrors('logo')
  }
}

// Submit form ke route + param id & role
const updateSite = () => {
  form.post(route('pengaturan_situs_update', { id: sitesStore.settings.id, role:menuStore.roleName }), {
    forceFormData: true,
    preserveScroll: true
  })
};
</script>
