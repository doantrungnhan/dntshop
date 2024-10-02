<?php

use App\Http\Controllers\admin\dashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::get('/', [dashboardController::class, 'index'])->name('admin.dashboard');
});