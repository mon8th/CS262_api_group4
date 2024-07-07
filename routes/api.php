<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyPasswordController;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard']);

    // Contact Form
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('api.contacts.index');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('api.contacts.destroy');
    });
    // Route::post('contact', [ContactController::class, 'send'])->name('api.contact.send');
    // Route::get('/mails', [ContactController::class, 'getMail'])->name('mails');  


    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/{product}', [ProductController::class, 'show']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
        Route::patch('/{product}/description', [ProductController::class, 'updateDescription']);
        Route::patch('/{product}/toggle-trending', [ProductController::class, 'toggleTrending']);
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('update', [ProfileController::class, 'update']);
        Route::delete('delete', [ProfileController::class, 'destroy']);
    });

    Route::prefix('users')->group(function () {
        Route::get('customers', [UserController::class, 'customers'])->name('api.users.customers');
        Route::get('hosts', [UserController::class, 'hosts'])->name('api.users.hosts');
        Route::post('customers', [UserController::class, 'createCustomer'])->name('api.users.customers.store');
        Route::post('hosts', [UserController::class, 'createHost'])->name('api.users.hosts.store');
        Route::put('{user}', [UserController::class, 'update'])->name('api.users.update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
        
        // Show lists of customers and hosts
        Route::get('lists', [UserController::class, 'showUsersByRole'])->name('api.users.lists');
    });
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index']);
        Route::get('/{id}', [TicketController::class, 'show']);
        Route::post('/', [TicketController::class, 'store']);
        Route::delete('/{id}', [TicketController::class, 'destroy']);
        Route::post('/search', [TicketController::class, 'search']);
    });
    //search
    Route::prefix('search')->group(function () {
        Route::post('users', [SearchController::class, 'searchUsers'])->name('api.search.users');
        Route::post('products', [SearchController::class, 'searchProducts'])->name('api.search.products');
        Route::post('tickets', [SearchController::class, 'searchTickets'])->name('api.search.tickets');
    });

    // Authentication
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Email Verification
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});
