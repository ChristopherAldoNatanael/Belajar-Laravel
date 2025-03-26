<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderDetailController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'store'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/chat', [PageController::class, 'chat'])->name('chat');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// Authenticated Routes (Pelanggan)
Route::middleware('auth:pelanggan')->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

  // Order Routes
  Route::get('/order', [OrderController::class, 'show'])->name('order.show'); // Menampilkan halaman order
  Route::post('/order/store', [OrderDetailController::class, 'store'])->name('order.details.store'); // Menyimpan pesanan

  // ORDER HISTORY
  Route::get('/order-history', [OrderDetailController::class, 'index'])->name('order.history');


});

// Profile routes
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/profile', [PelangganController::class, 'showProfile'])->name('pelanggan.profile');
    Route::put('/profile', [PelangganController::class, 'updateProfile'])->name('pelanggan.profile.update');
    Route::get('/change-password', [PelangganController::class, 'showChangePasswordForm'])->name('pelanggan.password.form');
    Route::put('/change-password', [PelangganController::class, 'updatePassword'])->name('pelanggan.password.update');
});

Route::post('/order/cancel/{orderId}', [OrderDetailController::class, 'cancelOrder'])
    ->name('order.cancel')
    ->middleware('auth:pelanggan');
