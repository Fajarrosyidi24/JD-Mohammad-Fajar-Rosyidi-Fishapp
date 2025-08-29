<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <section class="py-16 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto flex items-center justify-center mt-8">
                <div
                    class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-800 shadow-lg p-8 transform transition-all duration-300 hover:shadow-2xl"
                >
                    <!-- Judul -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Forgot Password
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            Masukkan email Anda, kami akan mengirim link reset password.
                        </p>
                    </div>

                    <!-- Status / Alert -->
                    <div
                        v-if="status"
                        class="mb-4 rounded-md bg-green-50 dark:bg-green-900 p-3 text-sm text-green-700 dark:text-green-300 border border-green-200 dark:border-green-700"
                    >
                        {{ status }}
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-5">
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <PrimaryButton
                                class="w-full py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Send Reset Link
                            </PrimaryButton>
                        </div>
                    </form>

                    <!-- Back to login -->
                    <div class="mt-6 text-center">
                        <Link
                            :href="route('login')"
                            class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                        >
                            Back to login
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
