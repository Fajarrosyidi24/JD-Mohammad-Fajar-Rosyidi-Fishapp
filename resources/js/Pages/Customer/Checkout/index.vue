<template>
  <Head title="Checkout" />
  <CustomerLayout>
    <section class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen mt-10">
      <FlashMessage type="success" class="mt-10" />
      <FlashMessage type="error" class="mt-10" />

      <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-6">
        <!-- Daftar produk & alamat -->
        <div class="flex-1 space-y-8">
          <CartItems :cart-items="checkoutData.cartItems" />
          <ShippingAddresses
            :addresses="shippingAddresses"
            :role="role"
            v-model:showModal="showModal"
            v-model:selectedAddress="selectedAddress"
          />

          <!-- Pilih Gateway -->
          <PaymentGatewaySelector
            :gateways="gateway"
            v-model:selectedGateway="selectedGateway"
          />
        </div>

        <!-- Ringkasan belanja -->
        <CheckoutSummary
          :total-items="checkoutData.totalItems"
          :total-price="checkoutData.totalPrice"
          :address="selectedAddress"
          :selected-gateway="selectedGateway"
          :cart-items="checkoutData.cartItems"
        />
      </div>
    </section>

    <AddAddressModal v-model:showModal="showModal" :role="role" />
  </CustomerLayout>
</template>

<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import CartItems from "./Components/CartItems.vue";
import ShippingAddresses from "./Components/ShippingAddresses.vue";
import CheckoutSummary from "./Components/CheckoutSummary.vue";
import AddAddressModal from "./Components/AddAddressModal.vue";
import PaymentGatewaySelector from "./Components/PaymentGatewaySelector.vue";

const props = defineProps({
  role: String,
  checkoutData: Object,
  shippingAddresses: {
    type: Array,
    default: () => [],
  },
  gateway: {
    type: Array,
    default: () => [],
  },
});

const showModal = ref(false);
const selectedAddress = ref(null);
const selectedGateway = ref(null);
</script>
