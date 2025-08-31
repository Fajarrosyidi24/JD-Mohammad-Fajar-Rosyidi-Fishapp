<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import { useMenuStore } from '@/Stores/menuStore';
import { router } from '@inertiajs/vue3';
import { useCartStore } from '@/Stores/cartStore'

const cartStore = useCartStore()
onMounted(() => {
  cartStore.fetchCartCount()
})


const menuStore = useMenuStore();
const logout = async () => {
  try {
    await axios.post(route('logout'))
    menuStore.resetMenus()
    router.visit(route('login'))
  } catch (error) {
    console.error('Logout failed', error)
  }
};

const page = usePage()
const routeCurrent = (name) => route().current(name)
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
  role: {
    type: String,
  },
});
</script>

<template>
  <header id="header" class="header fixed-top shadow-sm">
    <!-- Branding + Navigation -->
    <div class="branding py-2">
      <div class="container d-flex align-items-center justify-content-between">
        <Link :href="route('home', { role: role })" class="d-flex align-items-center gap-2 text-decoration-none">
        <img :src="sites.logo_url" :alt="sites.site_name"
          class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover" />
        <h1 class="sitename fs-5 fw-bold m-0">{{ sites.site_name }}</h1>
        </Link>

        <div class="d-flex align-items-center gap-3">
          <!-- Web Navigation -->
          <nav class="navmenu d-none d-lg-block">
            <ul class="list-unstyled m-0 d-flex gap-4">
              <li>
                <Link :href="route('home', { role: role })" :class="{ active: routeCurrent('home') }">Beranda</Link>
              </li>
              <li>
                <Link :href="route('product_auth', { role: role })" :class="{ active: routeCurrent('product_auth') }">
                Product</Link>
              </li>
            </ul>
          </nav>

          <!-- Cart Icon -->
          <Link :href="route('cart_index', { role: role })" class="text-decoration-none text-dark fs-5 position-relative ml-3">
          <i class="fas fa-shopping-cart text-white"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white">
            {{ cartStore.count }}
          </span>
          </Link>

          <!-- Profile Dropdown -->
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
              id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle fs-3 text-secondary"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
              <li>
                <Link class="dropdown-item" :href="route('dashboard', { role: role })">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </Link>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item text-danger" href="#" @click="logout">
                  <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
              </li>
            </ul>
          </div>

          <!-- Mobile toggle -->
          <button class="mobile-nav-toggle d-lg-none border-0 bg-transparent fs-3" @click="toggleMenu">
            <i :class="isMenuOpen ? 'bi bi-x-lg' : 'bi bi-list'"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Navigation -->
    <transition name="slide-fade">
      <nav v-if="isMenuOpen" class="mobile-nav d-lg-none">
        <ul class="list-unstyled m-0 p-0">
          <li>
            <Link :href="route('home', { role: role })" class="mobile-link" :class="{ active: routeCurrent('home') }"
              @click="toggleMenu">Beranda</Link>
          </li>
          <li>
            <Link :href="route('product_auth', { role: role })" class="mobile-link"
              :class="{ active: routeCurrent('product_auth') }" @click="toggleMenu">
            Product
            </Link>
          </li>
        </ul>
      </nav>
    </transition>
  </header>
</template>


<style scoped>
/* Custom Dropdown */
.dropdown-menu-custom {
  position: absolute;
  top: 100%;
  right: 0;
  min-width: 160px;
  background: #fff;
  border-radius: 6px;
  overflow: hidden;
  z-index: 1000;
}

.dropdown-item {
  display: block;
  padding: 0.5rem 1rem;
  color: #333;
  text-decoration: none;
  font-weight: 500;
}

.dropdown-item:hover {
  background: #f8f9fa;
}

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
