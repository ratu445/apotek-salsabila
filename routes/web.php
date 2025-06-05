<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
Auth::routes(['register' => false]);

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Master Data Routes
Route::middleware(['auth'])->group(function () {
    // Barang Routes
    Route::resource('barang', BarangController::class);
    
    // Kategori Routes
    Route::resource('kategori', KategoriController::class)->except(['show']);
    
    // Supplier Routes
    Route::resource('supplier', SupplierController::class)->except(['show']);
    
    // Pengguna Routes
    Route::resource('pengguna', PenggunaController::class)->except(['show']);
    
    // Resep Routes
    Route::resource('resep', ResepController::class);
    
    // Permintaan Routes
    Route::resource('permintaan', PermintaanController::class);
    Route::post('permintaan/{permintaan}/update-status', [PermintaanController::class, 'updateStatus'])
        ->name('permintaan.update-status');
    
    // Analisis Routes
    Route::resource('analisis', AnalisisController::class)->except(['edit', 'update']);
    
    // Laporan Routes
    Route::prefix('laporan')->group(function () {
        Route::get('stok', [LaporanController::class, 'stokBarang'])->name('laporan.stok');
        Route::get('permintaan', [LaporanController::class, 'permintaan'])->name('laporan.permintaan');
        Route::get('analisis', [LaporanController::class, 'analisisInventori'])->name('laporan.analisis');
    });
});