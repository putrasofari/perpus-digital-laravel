<?php

use App\Http\Controllers\User\BorrowingController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\FeedBackController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'user', 'active'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Catalogs
    Route::resource('catalogs', CatalogController::class)->only(['index', 'show'])->parameters(['catalogs' => 'book']);

    // Borrowings
    Route::resource('borrowings', BorrowingController::class)->only(['index', 'show', 'store', 'destroy']);
    Route::get('/books/{book}/borrow', [BorrowingController::class, 'create'])->name('borrowings.create');

    // Feedbacks
    Route::resource('feedbacks', FeedBackController::class)->only(['index', 'store', 'create', 'show', 'destroy']);
});
