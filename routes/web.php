<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo " This is Home page ";
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contactasd-asdf-asdfsad', [ContactController::class, 'index'])->name('darsh');

// Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
