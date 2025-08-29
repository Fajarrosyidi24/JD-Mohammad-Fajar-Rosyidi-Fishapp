<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Karyawan\DataKaryawanController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanHeroController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanAboutController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanSitusController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanDestinasiController;
use App\Http\Controllers\Admin\Pengaturan\PengaturanKeunggulanAboutController;


Route::get('/', [LandingPageController::class, 'home'])->name('home');

Route::middleware('auth', 'verified')->group(function () {
    Route::prefix('{role}')->group(function () {
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
    });
    Route::get('/menus', [MenuController::class, 'index'])->name('get.menus');
});

Route::get('/api/sites', [PengaturanSitusController::class, 'sitesjson'])->name('get.site');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';