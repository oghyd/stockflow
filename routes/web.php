<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FournisseurStockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('fournisseur')) {
            return redirect()->route('fournisseur.stock');
        }

        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:fournisseur')->group(function () {
        Route::get('/fournisseur/stock', [FournisseurStockController::class, 'index'])
            ->name('fournisseur.stock');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/activity', [ActivityLogController::class, 'index'])
            ->name('activity.index');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
    });

    Route::resource('products', ProductController::class)
        ->middleware('role:admin');

    Route::resource('suppliers', SupplierController::class)
        ->middleware('role:admin');

    Route::resource('categories', CategoryController::class)
        ->middleware('role:admin');

    Route::get('/admin/stock/report', [StockReportController::class, 'export'])
        ->middleware('role:admin')
        ->name('stock.report');

    Route::get('/caisse', function () {
        return view('caisse.index');
    })->name('caisse.index');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');
    Route::get('/sales/{sale}/receipt/download', [SaleController::class, 'downloadReceipt'])->name('sales.receipt.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
