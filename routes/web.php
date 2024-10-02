<?php

use Illuminate\Support\Facades\Route;

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('welcome');
});
=======
require __DIR__ . '/admin.php';
require __DIR__ . '/tag.php';

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> Stashed changes
