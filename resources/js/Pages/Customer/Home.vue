<script setup>
import { Head, Link } from '@inertiajs/vue3';
import CustomerLayout from '@/Layouts/CustomerLayout.vue';
import HeroSectionComponent from './Section/HeroSectionComponent.vue';
import ProductSectionComponent from './Section/ProductSectionComponent.vue';
import CategoriesSectionComponent from './Section/CategoriesSectionComponent.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { onMounted } from 'vue';
import { useMenuStore } from '@/Stores/menuStore';
const menuStore = useMenuStore()
onMounted(() => {
    menuStore.fetchMenus()
})

AOS.init({
  duration: 600,
  once: true, 
});

const props = defineProps({
   hero: {
        type: Object,
        default: () => []
    },
   products: {
        type: Object,
        default: () => []
    },
   categories: {
        type: Object,
        default: () => []
    },
});
</script>

<template>
    <Head title="Welcome" />
    <CustomerLayout>
        <HeroSectionComponent data-aos="fade-up" :hero="hero" :role="menuStore.getRoleName"/>
        <CategoriesSectionComponent data-aos="fade-up" :categories="categories" :role="menuStore.getRoleName"/>
        <ProductSectionComponent data-aos="fade-up" :products="products" :role="menuStore.getRoleName"/>
    </CustomerLayout>
</template>