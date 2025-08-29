<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <!-- Container -->
        <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-4">
            <div
                class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 space-y-6 border border-gray-200 dark:border-gray-700">
                
                <!-- Judul -->
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        Reset Password
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Masukkan password baru Anda untuk melanjutkan.
                    </p>
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Email -->
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email"
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 
                                   dark:bg-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                            v-model="form.email" required autofocus autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password -->
                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput id="password" type="password"
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 
                                   dark:bg-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                            v-model="form.password" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput id="password_confirmation" type="password"
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 
                                   dark:bg-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                            v-model="form.password_confirmation" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Tombol -->
                    <div>
                        <PrimaryButton
                            class="w-full py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md transition"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Reset Password
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
