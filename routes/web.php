<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/testing', function () {
        return view('livewire.testing-index');
    })->name('testing');

    // Add your new route for products here
    Route::get('/product', function () { 
        return view('livewire.product-index');
    })->name('product');
});
