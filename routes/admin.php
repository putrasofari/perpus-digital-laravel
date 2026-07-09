<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);
    Route::patch(
        '/users/{user}/reset-password',
        [UserController::class, 'resetPassword']
    )->name('users.reset-password');
    Route::patch(
        '/users/{user}/toggle-status',
        [UserController::class, 'toggleStatus']
    )->name('users.toggle-status');

    // All library features
    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);

    // All borrowings function
    Route::resource('borrowings', BorrowingController::class);
    Route::patch('/borrowings/{borrowing}/approved', [BorrowingController::class, 'approved'])->name('borrowings.approved');
    Route::patch('/borrowings/{borrowing}/rejected', [BorrowingController::class, 'rejected'])->name('borrowings.rejected');
    Route::patch('/borrowings/{borrowing}/borrowed', [BorrowingController::class, 'borrowed'])->name('borrowings.borrowed');
    Route::patch('/borrowings/{borrowing}/returned', [BorrowingController::class, 'returned'])->name('borrowings.returned');
});
