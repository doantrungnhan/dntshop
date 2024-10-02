<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


require __DIR__ . '/admin.php';
require __DIR__ . '/tag.php';

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
