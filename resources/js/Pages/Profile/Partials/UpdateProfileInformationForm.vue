<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import DangerButton from '@/Components/DangerButton.vue';

const user = usePage().props.auth.user;

// Setup form
const form = useForm({
    name: user.name,
    email: user.email,
    phone: user.detail?.phone || '',
    address: user.detail?.address || '',
    birth_date: user.detail?.birth_date || '',
    gender: user.detail?.gender || '',
    photo_profile: undefined,
    photo_ktp: undefined,
});

// Preview foto
const profilePreview = ref(user.detail?.profile_photo_url || '');
const ktpPreview = ref(user.detail?.ktp_url || '');

// Handle file input
const handleFileChange = (event, field) => {
    const file = event.target.files[0];

    if (file) {
        form[field] = file;

        const reader = new FileReader();
        reader.onload = e => {
            if (field === 'photo_profile') profilePreview.value = e.target.result;
            if (field === 'photo_ktp') ktpPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        form[field] = undefined;
        if (field === 'photo_profile') profilePreview.value = user.detail?.profile_photo_url || '';
        if (field === 'photo_ktp') ktpPreview.value = user.detail?.ktp_url || '';
    }
};

// Submit form
const submit = () => {
    form.post(route('profile.update'), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => console.log('Update berhasil'),
        onError: errors => console.log(errors),
    });
};
</script>

<template>
  <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Edit Profil</h1>

    <form @submit.prevent="submit" class="space-y-6">

      <!-- Nama & Email -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <InputLabel for="name" value="Nama" class="font-semibold" />
          <TextInput id="name" v-model="form.name" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700" />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>

        <div>
          <InputLabel for="email" value="Email" class="font-semibold" />
          <TextInput id="email" v-model="form.email" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700" />
          <InputError :message="form.errors.email" class="mt-1" />
        </div>
      </div>

      <!-- Phone & Birth Date -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <InputLabel for="phone" value="No. HP" class="font-semibold" />
          <TextInput id="phone" v-model="form.phone" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700" />
          <InputError :message="form.errors.phone" class="mt-1" />
        </div>

        <div>
          <InputLabel for="birth_date" value="Tanggal Lahir" class="font-semibold" />
          <TextInput id="birth_date" type="date" v-model="form.birth_date" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700" />
          <InputError :message="form.errors.birth_date" class="mt-1" />
        </div>
      </div>

      <!-- Address & Gender -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <InputLabel for="address" value="Alamat" class="font-semibold" />
          <TextInput id="address" v-model="form.address" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700" />
          <InputError :message="form.errors.address" class="mt-1" />
        </div>

        <div>
          <InputLabel for="gender" value="Jenis Kelamin" class="font-semibold" />
          <select v-model="form.gender" id="gender" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-2">
            <option value="">Pilih</option>
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
          </select>
          <InputError :message="form.errors.gender" class="mt-1" />
        </div>
      </div>

      <!-- Foto Profil & KTP -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <div class="flex flex-col items-center">
          <InputLabel value="Foto Profil" class="font-semibold mb-2" />
          <div class="w-32 h-32 mb-2 rounded-full overflow-hidden shadow-md">
            <img v-if="profilePreview" :src="profilePreview" class="w-full h-full object-cover" />
          </div>
          <input type="file" @change="e => handleFileChange(e, 'photo_profile')" class="text-sm text-gray-500 dark:text-gray-300" />
          <InputError :message="form.errors.photo_profile" class="mt-1" />
        </div>

        <div class="flex flex-col items-center">
          <InputLabel value="Foto KTP" class="font-semibold mb-2" />
          <div class="w-32 h-32 mb-2 rounded-lg overflow-hidden shadow-md">
            <img v-if="ktpPreview" :src="ktpPreview" class="w-full h-full object-cover" />
          </div>
          <input type="file" @change="e => handleFileChange(e, 'photo_ktp')" class="text-sm text-gray-500 dark:text-gray-300" />
          <InputError :message="form.errors.photo_ktp" class="mt-1" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <DangerButton type="submit" class="px-8 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition duration-200">
          Update Profil
        </DangerButton>
      </div>

    </form>
  </div>
</template>
