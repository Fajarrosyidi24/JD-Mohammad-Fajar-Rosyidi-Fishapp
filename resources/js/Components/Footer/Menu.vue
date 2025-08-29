<template>
    <!-- Menu -->
        <div>
          <h4 class="text-base font-semibold mb-4">Menu</h4>
          <ul class="space-y-2">
            <li><Link href="/" class="text-white hover:text-[#fecb3e]">Beranda</Link></li>
            <li><Link href="/login" class="text-white hover:text-[#fecb3e]">Login</Link></li>
          </ul>
        </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>