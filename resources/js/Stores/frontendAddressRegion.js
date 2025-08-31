// /stores/frontendAddressRegion.js
import { defineStore } from "pinia";
import axios from "axios";

export const useFrontendAddressRegion = defineStore("frontendAddressRegion", {
  state: () => ({
    provinces: [],
    cities: [],
    subdistricts: [],
    villages: [],
  }),

  getters: {
    getProvinces: (state) => state.provinces,
    getCities: (state) => state.cities,
    getSubdistricts: (state) => state.subdistricts,
    getVillages: (state) => state.villages,
  },

  actions: {
    async fetchProvinces() {
      try {
        const response = await axios.get("/provinces2");
        this.provinces = response.data.map((item) => ({
          id: item.province_id,
          name: item.province,
        }));
        return this.provinces;
      } catch (error) {
        console.error("Gagal mengambil provinsi:", error);
        this.provinces = [];
        throw error;
      }
    },

    async fetchCities(provinceId) {
      if (!provinceId) {
        this.cities = [];
        return [];
      }
      try {
        const response = await axios.get(`/cities2?province_id=${provinceId}`);
        this.cities = response.data.map((item) => ({
          id: item.city_id,
          name: item.city_name,
        }));
        return this.cities;
      } catch (error) {
        console.error("Gagal mengambil data kota:", error);
        this.cities = [];
        throw error;
      }
    },

    async fetchSubdistricts(cityId) {
      if (!cityId) {
        this.subdistricts = [];
        return [];
      }
      try {
        const response = await axios.get(`/subdistricts2?city_id=${cityId}`);
        this.subdistricts = response.data.map((item) => ({
          id: item.district_id,
          name: item.district_name,
        }));
        return this.subdistricts;
      } catch (error) {
        console.error("Gagal mengambil data kecamatan:", error);
        this.subdistricts = [];
        throw error;
      }
    },

    async fetchVillages(subdistrictName) {
      if (!subdistrictName) {
        this.villages = [];
        return [];
      }
      try {
        const response = await axios.get(`/villages?subdistrict=${subdistrictName}`);
        this.villages = response.data.map((item) => ({
          id: item.id,
          name: `${item.subdistrict_name} ${item.zip_code}`,
          code: item.zip_code,
        }));
        return this.villages;
      } catch (error) {
        console.error("Gagal mengambil data desa/kelurahan:", error);
        this.villages = [];
        throw error;
      }
    },
  },
});
