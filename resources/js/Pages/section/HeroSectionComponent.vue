<script setup>
import { Link } from '@inertiajs/vue3'
const props = defineProps({
  hero: {
    type: Object,
    default: () => []
  }
});
</script>

<template>
  <section id="home" class="hero section dark-background">
    <div class="hero-background">
      <img :src="hero.image_url" :alt="hero.title">
      <div class="overlay"></div>
    </div>

    <div class="container">
      <div class="row align-items-center">
        <!-- Konten Kiri -->
        <div class="col-lg-6">
          <div class="hero-content">
            <span class="hero-badge">{{ hero.button_text ?? 'Marketplace Nelayan' }}</span>
            <h1>{{ hero.title ?? 'Jual Beli Ikan Segar Langsung dari Nelayan' }}</h1>
            <p>{{ hero.subtitle ?? 'Dukung nelayan lokal dengan membeli ikan segar hasil tangkapan langsung dari pantai Muncar.' }}</p>
            
            <div class="hero-actions">
              <Link href="/product" class="btn-primary">Belanja Sekarang</Link>
              <a :href="hero.youtube_link" class="btn-secondary glightbox" v-if="hero.youtube_link">
                <i class="bi bi-play-circle"></i>
              <span>Lihat Video</span>
              </a>
            </div>

            <div class="hero-stats">
              <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">Ikan Segar</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">100+</span>
                <span class="stat-label">Nelayan Aktif</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Konten Kanan -->
        <div class="col-lg-6">
          <div class="hero-visual">
            <div class="row g-2">
              <div class="col-6">
                <div class="feature-card">
                  <i class="bi bi-basket"></i>
                  <span>Ikan Segar</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-people"></i>
                  <span>Dari Nelayan Lokal</span>
                </div>
              </div>
              <div class="col-6">
                <div class="feature-card">
                  <i class="bi bi-truck"></i>
                  <span>Pengiriman Cepat</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-shield-check"></i>
                  <span>Kualitas Terjamin</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
