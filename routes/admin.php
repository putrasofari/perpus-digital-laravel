<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::patch(
        '/users/{user}/reset-password',
        [UserController::class, 'resetPassword']
    )->name('users.reset-password');

    Route::patch(
        '/users/{user}/toggle-status',
        [UserController::class, 'toggleStatus']
    )->name('users.toggle-status');
    Route::resource('books', BookController::class);
});
