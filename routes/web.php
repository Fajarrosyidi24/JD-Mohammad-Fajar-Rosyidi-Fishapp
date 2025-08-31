<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AddresRegionController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanHeroController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanSitusController;
use App\Http\Controllers\Admin\UserManagement\UserManagementController;

Route::middleware('person')->group(function () {
    Route::get('/', [LandingPageController::class, 'home'])->name('welcome');
    Route::get('/product', [LandingPageController::class, 'product'])->name('product');
});

Route::get('/provinces2', [AddresRegionController::class, 'getProvinces'])->name('provinces.index');
Route::get('/cities2', [AddresRegionController::class, 'getCities'])->name('cities.index');
Route::get('/subdistricts2', [AddresRegionController::class, 'getSubdistricts'])->name('subdistricts.index');
Route::get('/villages', [AddresRegionController::class, 'getVillages'])->name('villages.index');

Route::middleware('auth', 'verified')->group(function () {
    Route::prefix('{role}')->group(function () {
        Route::get('/home', [CustomerController::class, 'index'])->name('home');
        Route::get('/product', [CustomerController::class, 'product'])->name('product_auth');
        Route::get('/product/show/{id}', [CustomerController::class, 'productDetail'])->name('product_detail_auth');
        Route::post('/product/show/{id}/{quantity}/{subtotal}', [CustomerController::class, 'cartStore'])->name('add_cart');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('pengaturan-situs')->group(function () {
            Route::get('/', [PengaturanSitusController::class, 'index'])->name('pengaturan_situs');
            Route::get('/edit/{id}', [PengaturanSitusController::class, 'edit'])->name('pengaturan_situs_edit');
            Route::post('/update/{id}', [PengaturanSitusController::class, 'update'])->name('pengaturan_situs_update');
        });
        Route::prefix('pengaturan-hero')->group(function () {
            Route::get('/', [PengaturanHeroController::class, 'index'])->name('pengaturan_hero');
            Route::get('/edit/{id}', [PengaturanHeroController::class, 'edit'])->name('pengaturan_hero_edit');
            Route::post('/update/{id}', [PengaturanHeroController::class, 'update'])->name('pengaturan_hero_update');
        });
        Route::prefix('manajemen-pengguna')->group(function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('manajemen_pengguna');
            Route::get('/show/{id}', [UserManagementController::class, 'show'])->name('karyawan.show');
        });

        Route::prefix('cart')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('cart_index');
            Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
            Route::post('/cart/checkout', [CartController::class, 'store'])->name('checkout.store');
        });
        Route::prefix('checkout')->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        });
        Route::prefix('address')->group(function () {
            Route::post('/', [AddresRegionController::class, 'store'])->name('shippingaddresses.store');
        });
    });
    Route::prefix('order')->group(function () {
        Route::post('/store', [OrderController::class, 'store'])->name('customer.orders.store');
    });
    Route::get('/menus', [MenuController::class, 'index'])->name('get.menus');
    Route::get('/cart/count', [CartController::class, 'cartCount'])->name('get.cart.count');

    Route::get('/order/success', function () {
        return "Pembayaran berhasil!";
    })->name('order.success');

    Route::get('/order/failed', function () {
        return "Pembayaran gagal!";
    })->name('order.failed');
});

Route::get('/api/sites', [PengaturanSitusController::class, 'sitesjson'])->name('get.site');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
Route::prefix('couriers')->group(function () {
    Route::get('/active', [CourierController::class, 'active'])->name('couriers.active');
});
