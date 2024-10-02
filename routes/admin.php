<?php

use App\Http\Controllers\admin\dashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::get('/', [dashboardController::class, 'index'])->name('admin.dashboard');

    // banners
    Route::get('/banners', [dashboardController::class, 'banners'])->name('admin.banners');
    Route::get('/banners/add', [dashboardController::class, 'banner_add'])->name('admin.banner.add');
    Route::post('/banners/store', [dashboardController::class, 'banner_store'])->name('admin.banner.store');
    Route::get('/banners/{bannerID}/edit', [dashboardController::class, 'banner_edit'])->name('admin.banner.edit');
    Route::put('/banners/update', [dashboardController::class, 'banner_update'])->name('admin.banner.update');
    Route::delete('/banners/{bannerID}/delete', [dashboardController::class, 'banner_delete'])->name('admin.banner.delete');

    // users
    Route::get('/users', [dashboardController::class, 'users'])->name('admin.users');
    Route::get('/users/add', [dashboardController::class, 'user_add'])->name('admin.user.add');
    Route::post('/users/store', [dashboardController::class, 'user_store'])->name('admin.user.store');
    Route::get('/users/{userID}/edit', [dashboardController::class, 'user_edit'])->name('admin.user.edit');
    Route::put('/users/update', [dashboardController::class, 'user_update'])->name('admin.user.update');
    Route::delete('/users/{userID}/delete', [dashboardController::class, 'user_delete'])->name('admin.user.delete');
});