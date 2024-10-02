<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


require __DIR__ . '/admin.php';

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
