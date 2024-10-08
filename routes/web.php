<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

>>>>>>> Stashed changes

require __DIR__ . '/admin.php';

Route::get('/', function () {
    return view('home');
})->name('home');
//đăng nhập đăng kí
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

