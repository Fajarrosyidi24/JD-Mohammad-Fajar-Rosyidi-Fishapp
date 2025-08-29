<template>
  <transition name="slide-fade" appear>
    <div
      v-if="message"
      :class="[bgClass, 'fixed top-6 right-6 z-50 flex items-center gap-3 p-4 rounded-lg shadow-lg text-white min-w-[250px]']"
    >
      <!-- Icon -->
      <span v-html="icon" class="text-xl"></span>

      <!-- Pesan -->
      <p class="flex-1 text-sm font-medium">{{ message }}</p>

      <!-- Close button -->
      <button @click="close" class="ml-2 text-white font-bold focus:outline-none">&times;</button>
    </div>
  </transition>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'

const props = defineProps({
  type: {
    type: String,
    default: 'success', // 'success' atau 'error'
  },
  duration: {
    type: Number,
    default: 4000,
  }
})

const page = usePage()
const visible = ref(true)

const message = computed(() => {
  if (!visible.value) return null
  if (props.type === 'success') return page.props.flash?.success
  if (props.type === 'error') return page.props.flash?.error
  return null
})

const bgClass = computed(() => props.type === 'success' ? 'bg-green-500' : 'bg-red-500')
const icon = computed(() => props.type === 'success' ? '✔️' : '❌')

// Auto dismiss
watch(message, (val) => {
  if (val) {
    setTimeout(() => visible.value = false, props.duration)
  }
})

function close() {
  visible.value = false
}
</script>

<style>
/* Animasi slide + fade dari atas */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.4s ease;
}
.slide-fade-enter-from {
  opacity: 0;
  transform: translateY(-20px);
}
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}
</style>
