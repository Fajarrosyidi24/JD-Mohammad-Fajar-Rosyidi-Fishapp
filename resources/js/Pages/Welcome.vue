<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import HeroSectionComponent from './section/HeroSectionComponent.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
  duration: 600,
  once: true, 
});

const props = defineProps({
   hero: {
        type: Object,
        default: () => []
    },
});
</script>

<template>
    <Head title="Welcome" />
    <GuestLayout>
        <HeroSectionComponent data-aos="fade-up" :hero="hero"/>
    </GuestLayout>
</template>
