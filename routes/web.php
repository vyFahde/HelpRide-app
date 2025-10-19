<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/cadastrar', function() {
    return view('driver_reg');
});
