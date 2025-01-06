<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Middleware untuk rute yang memerlukan autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [BranchController::class, 'index'])->name('dashboard');

    // Rute terkait cabang
    Route::prefix('branches/{id}')->group(function () {
        Route::get('/', [BranchController::class, 'show'])->name('branches.show');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    });

    Route::get('/branches/{branchId}/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/branches/{branchId}/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/branches/{branchId}/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/branches/{branchId}/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/branches/{branchId}/products/{productId}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/branches/{branchId}/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::middleware(['auth'])->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    });

    // Transaksi
    Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
    });

    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Profil
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Tambahkan autentikasi default Laravel
require __DIR__ . '/auth.php';
