<?php

use App\Http\Controllers\User\BorrowingController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'user', 'active'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('catalogs', CatalogController::class)->only(['index', 'show'])->parameters(['catalogs' => 'book']);
    
    Route::resource('borrowings', BorrowingController::class)->only(['index', 'show', 'store']);
    Route::get('/books/{book}/borrow', [BorrowingController::class, 'create'])->name('borrowings.create');
});
