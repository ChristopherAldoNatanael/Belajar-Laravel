<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
  Route::get('/order', [OrderController::class, 'show'])->name('order.show');
  Route::post('/order/store', [OrderDetailController::class, 'store'])->name('order.details.store');
  
  // New route for order details
  Route::get('/order/{orderId}', [OrderDetailController::class, 'show'])->name('order.details');



  // ORDER HISTORY - Fixed route
  Route::get('/order-history', [OrderController::class, 'history'])->name('order.history');
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

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Public admin routes (no auth required)
    Route::get('/', [UserController::class, 'showAdminLoginForm'])->name('adminLogin');
    Route::post('/authenticate', [UserController::class, 'adminLogin'])->name('authenticate');

    // Protected admin routes (auth required)
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'adminDashboard'])->name('dashboard');
        Route::get('/orders/{orderId}/details', [UserController::class, 'getOrderDetails'])->name('orders.details');
        Route::post('/sign-out', [UserController::class, 'adminLogout'])->name('signOut');

        // Order management - Fix the route for updating status
        Route::post('/orders/update-status', [UserController::class, 'updateOrderStatus'])->name('orders.updateStatus');
        Route::get('/orders/{orderId}', [OrderDetailController::class, 'adminShow'])->name('orders.show');

        // User Management Routes
        Route::prefix('user-management')->name('user-management.')->group(function() {
            Route::get('/', [PelangganController::class, 'adminIndex'])->name('index');
            Route::get('/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('edit');
            Route::delete('/{pelanggan}', [PelangganController::class, 'destroy'])->name('destroy');
        });
    
        // Menu Management Routes
        Route::prefix('menu-management')->name('menu-management.')->group(function() {
            Route::get('/', [MenuController::class, 'adminIndex'])->name('index');
            Route::get('/create', [MenuController::class, 'create'])->name('create');
            Route::post('/', [MenuController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('edit');
            Route::put('/{id}', [MenuController::class, 'update'])->name('update');
            Route::delete('/{id}', [MenuController::class, 'destroy'])->name('destroy');
        });
    });
});
