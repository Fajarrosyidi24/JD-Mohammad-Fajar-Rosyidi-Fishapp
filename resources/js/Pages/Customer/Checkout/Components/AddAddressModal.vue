<template>
  <div
    v-if="showModal"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-30"
  >
    <div
      class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-3xl p-4 relative max-h-[90vh] flex flex-col"
    >
      <!-- Tombol tutup -->
      <button
        @click="closeModal"
        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-sm"
      >
        ✕
      </button>

      <!-- Judul -->
      <h3
        class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100"
      >
        Tambah Alamat Baru
      </h3>

      <!-- Scrollable content -->
      <div class="overflow-y-auto flex-1">
        <form @submit.prevent="saveAddress" class="space-y-3">
          <!-- Nama & Email -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div class="md:col-span-2">
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Nama Lengkap</label
              >
              <input
                v-model="form.full_name"
                type="text"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
                placeholder="Nama penerima"
              />
              <p
                v-if="form.errors.full_name"
                class="text-xs text-red-500 mt-1"
              >
                {{ form.errors.full_name }}
              </p>
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Email (opsional)</label
              >
              <input
                v-model="form.email"
                type="email"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
                placeholder="email@contoh.com"
              />
              <p
                v-if="form.errors.email"
                class="text-xs text-red-500 mt-1"
              >
                {{ form.errors.email }}
              </p>
            </div>
          </div>

          <!-- Kontak -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Kode Negara</label
              >
              <input
                v-model="form.country_code"
                type="text"
                readonly
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 text-sm py-1 px-2"
              />
            </div>
            <div class="md:col-span-2">
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >No. Telepon</label
              >
              <input
                v-model="form.phone"
                type="tel"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
                placeholder="812xxx"
              />
              <p
                v-if="form.errors.phone"
                class="text-xs text-red-500 mt-1"
              >
                {{ form.errors.phone }}
              </p>
            </div>
          </div>

          <!-- Alamat & Negara -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div class="md:col-span-2">
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Alamat Lengkap</label
              >
              <textarea
                v-model="form.address"
                rows="2"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
                placeholder="Nama jalan, RT/RW, patokan"
              ></textarea>
              <p
                v-if="form.errors.address"
                class="text-xs text-red-500 mt-1"
              >
                {{ form.errors.address }}
              </p>
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Negara</label
              >
              <input
                v-model="form.country"
                type="text"
                readonly
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 text-sm py-1 px-2"
              />
            </div>
          </div>

          <!-- Wilayah -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Provinsi</label
              >
              <select
                v-model="form.province_id"
                @change="onProvinceChange"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              >
                <option value="">Pilih Provinsi</option>
                <option
                  v-for="prov in addressStore.getProvinces"
                  :key="prov.id"
                  :value="prov.id"
                >
                  {{ prov.name }}
                </option>
              </select>
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Kabupaten/Kota</label
              >
              <select
                v-model="form.city_id"
                @change="onCityChange"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              >
                <option value="">Pilih Kabupaten/Kota</option>
                <option
                  v-for="city in addressStore.getCities"
                  :key="city.id"
                  :value="city.id"
                >
                  {{ city.name }}
                </option>
              </select>
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Kecamatan</label
              >
              <select
                v-model="form.subdistrict_id"
                @change="onSubdistrictChange"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              >
                <option value="">Pilih Kecamatan</option>
                <option
                  v-for="sub in addressStore.getSubdistricts"
                  :key="sub.id"
                  :value="sub.id"
                >
                  {{ sub.name }}
                </option>
              </select>
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Desa/Kelurahan</label
              >
              <select
                v-model="form.village_id"
                @change="onVillageChange"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              >
                <option value="">Pilih Desa/Kelurahan</option>
                <option
                  v-for="v in addressStore.getVillages"
                  :key="v.id"
                  :value="v.id"
                >
                  {{ v.name }}
                </option>
              </select>
            </div>
          </div>

          <!-- Kode Pos & Koordinat -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Kode Pos</label
              >
              <input
                v-model="form.zip_code"
                type="text"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              />
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Latitude (opsional)</label
              >
              <input
                v-model="form.latitude"
                type="text"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              />
            </div>
            <div>
              <label
                class="block text-xs font-medium text-gray-700 dark:text-gray-300"
                >Longitude (opsional)</label
              >
              <input
                v-model="form.longitude"
                type="text"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1 px-2"
              />
            </div>
          </div>

          <!-- Tombol aksi -->
          <div class="flex justify-end space-x-2 mt-3">
            <button
              type="button"
              @click="closeModal"
              class="px-3 py-1 rounded bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm"
              :disabled="form.processing"
            >
              Batal
            </button>
            <button
              type="submit"
              class="px-3 py-1 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm disabled:opacity-60"
              :disabled="form.processing"
            >
              {{ form.processing ? "Menyimpan..." : "Simpan" }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useFrontendAddressRegion } from "@/stores/frontendAddressRegion";

const props = defineProps({
  role: String,
  showModal: Boolean,
});
const emit = defineEmits(["update:showModal"]);

const form = useForm({
  full_name: "",
  email: "",
  country_code: "+62",
  phone: "",
  country: "Indonesia",
  address: "",
  province_id: "",
  city_id: "",
  subdistrict_id: "",
  village_id: "",
  zip_code: "",
  latitude: "",
  longitude: "",
});

const addressStore = useFrontendAddressRegion();

// Close modal
const closeModal = () => {
  form.reset();
  form.clearErrors();
  emit("update:showModal", false);
};

// Save address
const saveAddress = () => {
  form.post(route("shippingaddresses.store", { role: props.role }), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      emit("update:showModal", false);
    },
  });
};

// fetch provinsi saat component mount
onMounted(async () => {
  await addressStore.fetchProvinces();
});

// Watch changes untuk dropdown
const onProvinceChange = async () => {
  await addressStore.fetchCities(form.province_id);
  form.city_id = "";
  form.subdistrict_id = "";
  form.village_id = "";
  form.zip_code = "";
};

const onCityChange = async () => {
  await addressStore.fetchSubdistricts(form.city_id);
  form.subdistrict_id = "";
  form.village_id = "";
  form.zip_code = "";
};

const onSubdistrictChange = async () => {
  // Karena villages diambil berdasarkan nama kecamatan
  const selected = addressStore.getSubdistricts.find(
    (s) => s.id === form.subdistrict_id
  );
  if (selected) {
    await addressStore.fetchVillages(selected.name);
  }
  form.village_id = "";
  form.zip_code = "";
};

const onVillageChange = () => {
  const selected = addressStore.getVillages.find(
    (v) => v.id === form.village_id
  );
  form.zip_code = selected ? selected.code : "";
};
</script>