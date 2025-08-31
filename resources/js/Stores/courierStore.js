// resources/js/Stores/courierStore.js
import { defineStore } from "pinia";
import axios from "axios";

export const useCourierStore = defineStore("courier", {
  state: () => ({
    couriers: [],        // hasil response kurir
    loading: false,      // status loading
    error: null,         // untuk simpan pesan error
  }),

  actions: {
    async fetchActiveCouriers(villageId, weight = 1000) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/couriers/active", {
          params: {
            village_id: villageId,
            weight: weight,
          },
        });

        this.couriers = response.data;
      } catch (err) {
        console.error("Gagal ambil kurir:", err);
        this.error = err.response?.data?.message || "Gagal mengambil data kurir";
      } finally {
        this.loading = false;
      }
    },
  },

  getters: {
    // contoh getter: ambil kurir termurah
    cheapestCourier: (state) => {
      if (!state.couriers.length) return null;
      return [...state.couriers].sort((a, b) => a.cost - b.cost)[0];
    },
    // contoh getter: grup kurir berdasarkan code
    couriersByCode: (state) => {
      return state.couriers.reduce((acc, courier) => {
        if (!acc[courier.code]) {
          acc[courier.code] = [];
        }
        acc[courier.code].push(courier);
        return acc;
      }, {});
    },
  },
});
