<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900 h-screen overflow-y-auto">
        <HeaderComponent :role="menuStore.roleName" />
        <SidebarComponent :menus="menuStore.menus" :roleName="menuStore.roleName" />
        <main class="p-4 md:ml-64 pt-20 mt-10">
            <div class="rounded-lg border-gray-300 dark:border-gray-600 w-full mt-8 mb-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import SidebarComponent from './Auth/SidebarComponent.vue';
import HeaderComponent from './Auth/HeaderComponent.vue';
import { useMenuStore } from '@/Stores/menuStore';

const menuStore = useMenuStore();

onMounted(() => {
    menuStore.fetchMenus();
});
</script>
