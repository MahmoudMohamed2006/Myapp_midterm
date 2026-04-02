<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\profileController;

// Public catalogue
Route::get('/', [BookController::class, 'index'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'create'])->name('login');
    Route::post('login', [AuthController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

    // Admin & Librarian Shared Routes
    Route::middleware('role:Admin,Librarian')->group(function () {
        Route::get('/members', [AdminController::class, 'members'])->name('members.index');
        Route::resource('books', BookController::class)->except(['index', 'show']);
    });

    // Admin Only Routes
    Route::middleware('role:Admin')->group(function () {
        Route::get('/admin/roles', [AdminController::class, 'roles'])->name('admin.roles');
        Route::get('/admin/librarians/create', [AdminController::class, 'createLibrarian'])->name('librarians.create');
        Route::post('/admin/librarians', [AdminController::class, 'storeLibrarian'])->name('librarians.store');
    });

    // Member / General Authenticated Action Routes
    Route::get('/profile', [profileController::class, 'index'])->name('profile');
    Route::post('/borrow/{book}', [BorrowingController::class, 'store'])->name('borrow.store');
});
