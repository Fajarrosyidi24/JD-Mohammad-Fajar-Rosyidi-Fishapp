<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'

const showPassword = ref(false)

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />
        <section id="tourist-destination" class="py-16 bg-gray-50 dark:bg-gray-900" data-aos="fade-up">

            <div class="container mx-auto flex items-center justify-center mt-8">
                <div class="w-full max-w-md mt-8 rounded-2xl bg-white dark:bg-gray-800 shadow-lg p-8 transform transition-all duration-300 hover:shadow-2xl"
                    data-aos="fade-up">
                    <!-- Judul -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Welcome Back
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            Silakan login untuk melanjutkan
                        </p>
                    </div>
                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-5">
                        <!-- Email -->
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" type="email"
                                class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                                v-model="form.email" required autofocus autocomplete="username" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <!-- Password -->
                        <div>
                            <InputLabel for="password" value="Password" />

                            <div class="relative">
                                <TextInput id="password" :type="showPassword ? 'text' : 'password'" class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 
                   dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 pr-10" v-model="form.password"
                                    required autocomplete="current-password" />

                                <!-- Ikon toggle -->
                                <div class="absolute inset-y-0 right-2 flex">
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="absolute inset-y-0  right-2 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                        <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                                    </button>
                                </div>
                            </div>

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <!-- Remember -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2">Remember me</span>
                            </label>

                            <Link v-if="canResetPassword" :href="route('password.request')"
                                class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Forgot password?
                            </Link>
                        </div>

                        <!-- Tombol -->
                        <div>
                            <PrimaryButton
                                class="w-full py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>