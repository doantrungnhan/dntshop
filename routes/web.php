<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\myAccountController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/admin.php';
require __DIR__ . '/tag.php';

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::get('my-account',[myAccountController::class,'index'])->name('account');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);