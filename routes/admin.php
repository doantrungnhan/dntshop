<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\dashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::get('/', [dashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('category')->group(function(){
        Route::get('/',[CategoryController::class, 'index'])->name('admin.category');
        Route::delete('/{id}', [CategoryController::class,'delete']);
    });

});
