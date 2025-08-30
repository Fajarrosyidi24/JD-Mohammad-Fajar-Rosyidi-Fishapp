<template>
    <nav
        class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
        <div class="flex justify-between items-center w-full">
            <DrawerComponent :role="role" />
            <div class="flex items-center justify-center">
                <ProfileComponent />
            </div>
        </div>
    </nav>
</template>

<script setup>
import DrawerComponent from './Components/DrawerComponent.vue';
import ProfileComponent from './Components/ProfileComponent.vue';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
onMounted(() => {
    initFlowbite();
});

const props = defineProps({
  role: String
});
</script>

<style scoped>
.profile-sty {
    margin-right: 30px;
}
</style>