<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return  'hello word';
});

Route::get('/hhome', function(){
    return  'hello word';
});
