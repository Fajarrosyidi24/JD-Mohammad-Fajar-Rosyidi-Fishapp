<template>
  <button type="button" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation" class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 
           dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 
           focus:ring-gray-300 dark:focus:ring-gray-600">
  </button>

  <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 
           focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false"
    data-dropdown-toggle="dropdown">
    <span class="sr-only">Open user menu</span>
    <div class="w-8 h-8 rounded-full overflow-hidden">
  <img 
    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" 
    alt="user photo"
    class="w-full h-full object-cover"
  />
</div>

  </button>

  <div id="dropdown" class="hidden z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 
           rounded-xl shadow dark:bg-gray-700 dark:divide-gray-600">
    <!-- Profil -->
    <div class="py-3 px-4">
      <span class="block text-sm font-semibold text-gray-900 dark:text-white">
        {{ $page.props.auth.user.name }}
      </span>
      <span class="block text-sm text-gray-900 truncate dark:text-white">
        {{ $page.props.auth.user.email }}
      </span>
    </div>

    <!-- Menu 1 -->
    <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
      <li>
        <Link href="/profile" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 
                 dark:text-gray-400 dark:hover:text-white">
        profile
        </Link>
      </li>
    </ul>

    <!-- Logout -->
    <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
      <li>
        <a href="#" @click="logout" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 
                 dark:hover:text-white">
          Sign out
        </a>
      </li>
    </ul>
  </div>
</template>

<script setup>
import 'flowbite';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { useMenuStore } from '@/Stores/menuStore';
import { Link } from '@inertiajs/vue3'

const menuStore = useMenuStore();

onMounted(() => {
  initFlowbite();
})

const logout = async () => {
  try {
    await axios.post(route('logout'))
    menuStore.resetMenus()
    router.visit(route('login'))
  } catch (error) {
    console.error('Logout failed', error)
  }
};
</script>
