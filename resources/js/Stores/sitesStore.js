import { defineStore } from 'pinia'
import axios from 'axios'

export const useSitesStore = defineStore('sites', {
  id: 'sites',

  state: () => ({
    settings: null,
    loading: false,
    error: null,
  }),

  getters: {
    logoUrl: (state) => state.settings?.logo_url ?? null,
    siteName: (state) => state.settings?.site_name ?? '',
  },

  actions: {
    async fetchSites() {
      this.loading = true
      this.error = null
      try {
        const { data } = await axios.get('/api/sites')
        this.settings = data
      } catch (err) {
        this.error = err.response?.data?.message || err.message
      } finally {
        this.loading = false
      }
    },
  },
})
