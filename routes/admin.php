<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\BannerController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::get('/', [dashboardController::class, 'index'])->name('admin.dashboard');

    // banners
    Route::get('/banners', [BannerController::class, 'banners'])->name('admin.banners');
    Route::get('/banners/add', [BannerController::class, 'banner_add'])->name('admin.banner.add');
    Route::post('/banners/store', [BannerController::class, 'banner_store'])->name('admin.banner.store');
    Route::get('/banners/{bannerID}/edit', [BannerController::class, 'banner_edit'])->name('admin.banner.edit');
    Route::put('/banners/update', [BannerController::class, 'banner_update'])->name('admin.banner.update');
    Route::delete('/banners/{bannerID}/delete', [BannerController::class, 'banner_delete'])->name('admin.banner.delete');

    // users
    Route::get('/users', [UserController::class, 'users'])->name('admin.users');
    Route::get('/users/add', [UserController::class, 'user_add'])->name('admin.user.add');
    Route::post('/users/store', [UserController::class, 'user_store'])->name('admin.user.store');
    Route::get('/users/{userID}/edit', [UserController::class, 'user_edit'])->name('admin.user.edit');
    Route::put('/users/update', [UserController::class, 'user_update'])->name('admin.user.update');
    Route::delete('/users/{userID}/delete', [UserController::class, 'user_delete'])->name('admin.user.delete');
});