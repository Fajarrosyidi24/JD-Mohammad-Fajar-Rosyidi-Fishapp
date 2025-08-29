<template>
  <aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full md:translate-x-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-y-auto"
    aria-label="Sidenav" id="drawer-navigation"
  >
    <ul class="py-5 px-3 space-y-2">
      <li v-for="(menu, index) in menus" :key="index">
        <div v-if="menu.children?.length">
          <button
            type="button"
            class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            :aria-controls="'dropdown-' + index"
            :aria-expanded="openDropdowns[index] ? 'true' : 'false'"
            @click="toggleDropdown(index)"
          >
            <i v-if="menu.icon" :class="menu.icon + ' w-5 h-5'"></i>
            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ menu.name }}</span>
            <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <ul v-show="openDropdowns[index]" class="py-2 space-y-2 ml-4 border-l border-gray-200 dark:border-gray-700">
            <li v-for="(child, cIndex) in menu.children" :key="cIndex">
              <Link :href="route(child.slug, { role: roleName })"
                class="flex items-center p-2 pl-4 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                <i v-if="child.icon" :class="child.icon + ' w-4 h-4 mr-2'"></i>
                {{ child.name }}
              </Link>
            </li>
          </ul>
        </div>

        <!-- Menu tanpa children -->
        <div v-else>
          <Link :href="route(menu.slug, { role: roleName })"
            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <i v-if="menu.icon" :class="menu.icon + ' w-5 h-5'"></i>
            <span class="ml-3">{{ menu.name }}</span>
          </Link>
        </div>
      </li>
    </ul>
  </aside>
</template>


<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { Link } from '@inertiajs/vue3'
onMounted(() => {
  initFlowbite();
})

const props = defineProps({
  menus: {
    type: Array,
    default: () => []
  },
  roleName: String
});

const openDropdowns = ref({});
const toggleDropdown = (index) => {
  openDropdowns.value[index] = !openDropdowns.value[index];
};
</script>
