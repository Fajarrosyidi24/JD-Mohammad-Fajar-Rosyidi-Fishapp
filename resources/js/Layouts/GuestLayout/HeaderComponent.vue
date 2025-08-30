<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const page = usePage()
const isMenuOpen = ref(false)
const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}
const isDropdownOpen = ref(false)
const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value
}

const props = defineProps({
  sites: {
    type: Object,
    default: () => []
  },
});
</script>

<template>
  <header id="header" class="header fixed-top shadow-sm">

    <!-- Branding + Navigation -->
    <div class="branding py-2">
      <div class="container d-flex align-items-center justify-content-between">
        <Link href="/" class="d-flex align-items-center gap-2 text-decoration-none">
        <img :src="sites.logo_url" :alt="sites.site_name"
          class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover" />
        <h1 class="sitename fs-5 fw-bold m-0">{{ sites.site_name }}</h1>
        </Link>
        <button class="mobile-nav-toggle d-lg-none border-0 bg-transparent fs-3" @click="toggleMenu">
          <i :class="isMenuOpen ? 'bi bi-x-lg' : 'bi bi-list'"></i>
        </button>

        <!-- Web Navigation -->
        <nav class="navmenu d-none d-lg-block">
          <ul class="list-unstyled m-0 d-flex gap-4">
            <li>
              <Link href="/" :class="{ active: page.url === '/' }">Beranda</Link>
            </li>
            <li>
              <Link href="/product" :class="{ active: page.url.startsWith('/product') }">Product</Link>
            </li>
            <li>
              <Link href="/login" :class="{ active: page.url === '/login' }">Login</Link>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Mobile Navigation -->
    <transition name="slide-fade">
      <nav v-if="isMenuOpen" class="mobile-nav d-lg-none">
        <ul class="list-unstyled m-0 p-0">
          <li>
            <Link href="/" class="mobile-link" :class="{ active: page.url === '/' }" @click="toggleMenu">Beranda</Link>
          </li>
          <li>
            <Link href="/product" class="mobile-link" :class="{ active: page.url.startsWith('/product') }"
              @click="toggleMenu">
            Product
            </Link>
          </li>

          <li>
            <Link href="/login" class="mobile-link" :class="{ active: page.url === '/login' }" @click="toggleMenu">Login
            </Link>
          </li>
        </ul>
      </nav>
    </transition>
  </header>
</template>

<style scoped>
/* Mobile Navigation */
.mobile-nav {
  background: white;
  border-top: 1px solid #eee;
  padding: 0.5rem 0;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.mobile-link {
  display: block;
  padding: 0.75rem 1rem;
  color: #333;
  text-decoration: none;
  border-bottom: 1px solid #f0f0f0;
  font-weight: 500;
}

.mobile-link.active {
  background: #fff8f0;
  color: orange;
}

.mobile-link:hover {
  background: #f9f9f9;
}

/* Dropdown Menu (Desktop) */
.dropdown-menu {
  display: none;
  position: absolute;
  background: white;
  top: 100%;
  left: 0;
  min-width: 180px;
}

.dropdown:hover .dropdown-menu {
  display: block;
}

/* Animations */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
