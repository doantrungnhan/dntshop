<?php

use App\Http\Controllers\admin\categoriesController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\orderController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix('admin')->group(function() {
    Route::get('/', [dashboardController::class, 'index'])->name('admin.dashboard');


    //Order
    Route::prefix('order')->group(function (){
        Route::get('/', [orderController::class,'index'])->name('admin.order');
        Route::get('{code}/detail',[orderController::class,'order_detail'])->name('admin.order.detail');
        Route::patch('{id}/status',[orderController::class,'update_order_status'])->name('admin.order.status');
    });

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

   //categories
    Route::get('/categories', [categoriesController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/add', [categoriesController::class, 'categories_add'])->name('admin.categories.add');
    Route::post('/categories/store', [categoriesController::class, 'categories_store'])->name('admin.categories.store');
    Route::get('/categories/{categoriesID}/edit', [categoriesController::class, 'categories_edit'])->name('admin.categories.edit');
    Route::put('/categories/{categoriesID}/update', [categoriesController::class, 'categories_update'])->name('admin.categories.update');
    Route::delete('/categories/{categoriesID}/delete', [categoriesController::class, 'categories_delete'])->name('admin.categories.delete');
});
