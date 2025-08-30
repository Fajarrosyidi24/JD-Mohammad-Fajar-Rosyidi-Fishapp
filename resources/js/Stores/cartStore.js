import { defineStore } from 'pinia'
import axios from 'axios'

export const useCartStore = defineStore('cart', {
  state: () => ({
    count: 0,
    loading: false,
    error: null,
  }),

  actions: {
    async fetchCartCount() {
      this.loading = true
      this.error = null
      try {
        const response = await axios.get(route('get.cart.count'))
        this.count = response.data.count
      } catch (err) {
        this.error = err.response?.data?.message || 'Gagal mengambil data cart'
      } finally {
        this.loading = false
      }
    },

    increment() {
      this.count++
    },

    decrement() {
      if (this.count > 0) {
        this.count--
      }
    },

    reset() {
      this.count = 0
    }
  },

  getters: {
    hasItems: (state) => state.count > 0,
  }
})
