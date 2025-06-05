<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource Routes
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('supplier', SupplierController::class)->except(['show']);
    Route::resource('barang', BarangController::class);
    Route::resource('pengguna', PenggunaController::class)->except(['show']);
    Route::resource('resep', ResepController::class);
    Route::resource('transaksi', TransaksiController::class);
    
    // Additional Routes
    Route::get('laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
    Route::get('laporan/penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
    Route::get('laporan/expired', [LaporanController::class, 'expired'])->name('laporan.expired');
    
    // API Routes for Select2
    Route::get('api/barang', [BarangController::class, 'api'])->name('api.barang');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
