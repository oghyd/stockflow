<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::resource('suppliers', \App\Http\Controllers\SupplierController::class)->middleware(['auth', 'role:admin']);

Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware(['auth', 'role:admin']);

    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/activity', function () {
            return view('admin.activity.index');
        })->name('activity.index');

        Route::resource('users', \App\Http\Controllers\UserController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';