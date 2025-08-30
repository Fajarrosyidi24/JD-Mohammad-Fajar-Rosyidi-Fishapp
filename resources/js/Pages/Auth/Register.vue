<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const showPassword = ref(false);
const showPassword2 = ref(false);
const photoProfilePreview = ref(null);
const photoKTPPreview = ref(null);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    birth_date: '',
    address: '',
    gender: '',
    password: '',
    password_confirmation: '',
    photo_profile: null,
    photo_ktp: null,
    remember: false,
});

const submit = () => {
    form.post(route('register'), {
        preserveScroll: true,
    });
};

// Preview images
watch(() => form.photo_profile, (file) => {
    if (file) {
        photoProfilePreview.value = URL.createObjectURL(file);
    }
});
watch(() => form.photo_ktp, (file) => {
    if (file) {
        photoKTPPreview.value = URL.createObjectURL(file);
    }
});
</script>

<template>
<GuestLayout>
    <Head title="Register Account" />

    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto flex items-center justify-center mt-8">
            <div class="w-full max-w-md mt-8 rounded-2xl bg-white dark:bg-gray-800 shadow-lg p-8 transform transition-all duration-300 hover:shadow-2xl">
                
                <!-- Judul -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Selamat Datang</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Silakan selesaikan pendaftaran anda untuk melanjutkan
                    </p>
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="space-y-5" enctype="multipart/form-data">

                    <!-- Nama -->
                    <div>
                        <InputLabel for="name" value="Nama" />
                        <TextInput id="name" type="text" v-model="form.name" required
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <!-- Email -->
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" v-model="form.email" required
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <InputLabel for="phone" value="Nomor Telepon" />
                        <TextInput id="phone" type="tel" v-model="form.phone" required
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <InputLabel for="birth_date" value="Tanggal Lahir" />
                        <TextInput id="birth_date" type="date" v-model="form.birth_date" required
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        <InputError class="mt-2" :message="form.errors.birth_date" />
                    </div>

                    <!-- Alamat -->
                    <div>
                        <InputLabel for="address" value="Alamat" />
                        <textarea id="address" v-model="form.address" required placeholder="Masukkan alamat lengkap"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"></textarea>
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <InputLabel for="gender" value="Jenis Kelamin" />
                        <select id="gender" v-model="form.gender" required
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>

                    <!-- Photo Profile -->
                    <div>
                        <InputLabel for="photo_profile" value="Photo Profile" />
                        <input id="photo_profile" type="file" accept="image/*"
                            @change="e => form.photo_profile = e.target.files[0]"
                            class="mt-2 block w-full text-gray-700 dark:text-gray-300 file:border file:border-gray-300 file:rounded-lg file:px-3 file:py-2 file:bg-gray-100 dark:file:bg-gray-700 file:text-gray-700 dark:file:text-gray-300 focus:ring-2 focus:ring-indigo-500" required />
                        <InputError class="mt-2" :message="form.errors.photo_profile" />
                        <div v-if="photoProfilePreview" class="mt-2">
                            <img :src="photoProfilePreview" class="w-32 h-32 object-cover rounded-lg border" alt="Preview Photo Profile" />
                        </div>
                    </div>

                    <!-- Photo KTP -->
                    <div>
                        <InputLabel for="photo_ktp" value="Photo KTP" />
                        <input id="photo_ktp" type="file" accept="image/*"
                            @change="e => form.photo_ktp = e.target.files[0]"
                            class="mt-2 block w-full text-gray-700 dark:text-gray-300 file:border file:border-gray-300 file:rounded-lg file:px-3 file:py-2 file:bg-gray-100 dark:file:bg-gray-700 file:text-gray-700 dark:file:text-gray-300 focus:ring-2 focus:ring-indigo-500" required />
                        <InputError class="mt-2" :message="form.errors.photo_ktp" />
                        <div v-if="photoKTPPreview" class="mt-2">
                            <img :src="photoKTPPreview" class="w-32 h-32 object-cover rounded-lg border" alt="Preview Photo KTP" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <InputLabel for="password" value="Password" />
                        <div class="relative">
                            <TextInput id="password" :type="showPassword ? 'text' : 'password'" v-model="form.password" required
                                class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 pr-10" />
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                            </button>
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <InputLabel for="password_confirmation" value="Konfirmasi Password" />
                        <div class="relative">
                            <TextInput id="password_confirmation" :type="showPassword2 ? 'text' : 'password'" v-model="form.password_confirmation" required
                                class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 pr-10" />
                            <button type="button" @click="showPassword2 = !showPassword2"
                                class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                <i :class="showPassword2 ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                            </button>
                        </div>
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center">
                        <label class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2">Remember me</span>
                        </label>
                    </div>

                    <!-- Tombol Submit -->
                    <div>
                        <PrimaryButton
                            class="w-full py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Daftar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </section>
</GuestLayout>
</template>
