<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CategoryController;
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

        if ($user->hasRole('vendeur')) {
            return redirect()->route('caisse.index');
        }

        if ($user->hasRole('fournisseur')) {
            return redirect()->route('products.index');
        }

        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/activity', [ActivityLogController::class, 'index'])
            ->name('activity.index');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);
    });

    // Products:
    // admin = full CRUD
    // fournisseur = index/show only for their own products
    Route::middleware('role:admin|fournisseur')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::resource('suppliers', SupplierController::class);
        Route::resource('categories', CategoryController::class);

        Route::get('/admin/stock/report', [StockReportController::class, 'export'])
            ->name('stock.report');
    });

    // Caisse = admin + vendeur only
    Route::get('/caisse', function () {
        return view('caisse.index');
    })->middleware('role:admin|vendeur')->name('caisse.index');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');
    Route::get('/sales/{sale}/receipt/download', [SaleController::class, 'downloadReceipt'])->name('sales.receipt.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';