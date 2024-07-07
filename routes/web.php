<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::get('/profile/view', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/help', function () {
        return view('help');
    })->name('help');
});
Route::get('/productstock', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('productstock');

Route::get('/ticketslist', [TicketController::class, 'index'])->name('ticketslist');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/customers', [UserController::class, 'customers'])->name('customers.index');
    Route::get('/hosts', [UserController::class, 'hosts'])->name('hosts.index');
    Route::get('/users/createCustomer', [UserController::class, 'createCustomer'])->name('customers.create');
    Route::post('/customers', [UserController::class, 'store'])->name('customers.store');
    Route::get('/users/createHost', [UserController::class, 'createHost'])->name('hosts.create');
    Route::post('/hosts', [UserController::class, 'store'])->name('hosts.store');
    Route::get('/customers/{user}/edit', [UserController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{user}', [UserController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{user}', [UserController::class, 'destroy'])->name('customers.destroy');
    Route::get('/hosts/{user}/edit', [UserController::class, 'edit'])->name('hosts.edit');
    Route::put('/hosts/{user}', [UserController::class, 'update'])->name('hosts.update');
    Route::delete('/hosts/{user}', [UserController::class, 'destroy'])->name('hosts.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/search', [SearchController::class, 'search'])->name('search');
 
