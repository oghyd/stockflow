<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FournisseurStockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fournisseur routes
    Route::middleware('role:fournisseur')->group(function () {
        Route::get('/fournisseur/stock', [FournisseurStockController::class, 'index'])
            ->name('fournisseur.stock');
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/activity', [ActivityLogController::class, 'index'])
            ->name('activity.index');

        Route::resource('users', UserController::class);
    });

    // Admin-only resources
    Route::resource('products', ProductController::class)
        ->middleware('role:admin');

    Route::resource('suppliers', SupplierController::class)
        ->middleware('role:admin');

    Route::resource('categories', CategoryController::class)
        ->middleware('role:admin');

    Route::get('/admin/stock/report', [StockReportController::class, 'export'])
        ->middleware('role:admin')
        ->name('stock.report');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';