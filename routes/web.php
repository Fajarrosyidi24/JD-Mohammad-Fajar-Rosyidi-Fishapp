<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanHeroController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanSitusController;
use App\Http\Controllers\Admin\UserManagement\UserManagementController;

Route::middleware('person')->group(function () {
    Route::get('/', [LandingPageController::class, 'home'])->name('welcome');
    Route::get('/product', [LandingPageController::class, 'product'])->name('product');
});

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
    });
    Route::get('/menus', [MenuController::class, 'index'])->name('get.menus');
    Route::get('/cart/count', [CartController::class, 'index'])->name('get.cart.count');
});

Route::get('/api/sites', [PengaturanSitusController::class, 'sitesjson'])->name('get.site');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
