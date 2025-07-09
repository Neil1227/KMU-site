<?php

use Illuminate\Support\Facades\Route;

// ✅ Static page: no logic or data passed, just a Blade file
Route::view('/index', 'index');
Route::view('/homepage', 'homepage');

// ✅ Dynamic page: use a closure if you plan to add logic later
Route::get('/contact', function () {
    // You can add logic or pass data here in the future
    return view('contact');
});
