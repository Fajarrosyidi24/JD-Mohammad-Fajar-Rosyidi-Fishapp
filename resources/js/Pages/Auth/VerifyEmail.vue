<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <section class="py-16 bg-gray-50 dark:bg-gray-900" data-aos="fade-up">
            <div class="container mx-auto flex items-center justify-center">
                <div
                    class="w-full max-w-md mt-8 rounded-2xl bg-white dark:bg-gray-800 shadow-lg p-8 transform transition-all duration-300 hover:shadow-2xl"
                    data-aos="fade-up"
                >
                    <!-- Judul -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Verify Your Email
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                            Thanks for signing up! Please check your email for a verification link before continuing.
                        </p>
                    </div>

                    <!-- Notif berhasil kirim ulang -->
                    <div
                        v-if="verificationLinkSent"
                        class="mb-4 p-3 rounded-lg text-sm font-medium text-green-700 bg-green-100 dark:bg-green-800 dark:text-green-200"
                    >
                        A new verification link has been sent to the email address you provided during registration.
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-5 mt-6">
                        <div class="flex items-center justify-between">
                            <PrimaryButton
                                class="w-full py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Resend Verification Email
                            </PrimaryButton>
                        </div>

                        <div class="text-center mt-4">
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            >
                                Log Out
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
