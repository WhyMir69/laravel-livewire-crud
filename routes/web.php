<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;

// Authentication Routes (Livewire)
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

// Logout route
Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('welcome');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
});
