<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

// Fournisseur routes
Route::middleware(['auth', 'role:fournisseur'])->group(function () {
    Route::get('/fournisseur/stock', [App\Http\Controllers\FournisseurStockController::class, 'index'])->name('fournisseur.stock');
});


Route::get('/admin/stock/report', [App\Http\Controllers\StockReportController::class, 'export'])->name('stock.report');

Route::resource('products', \App\Http\Controllers\ProductController::class)->middleware(['auth', 'role:admin']);


Route::resource('suppliers', \App\Http\Controllers\SupplierController::class)->middleware(['auth', 'role:admin']);

Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware(['auth', 'role:admin']);

    Route::get('/caisse', function () {
        return view('caisse.index');
    })->name('caisse.index');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
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
