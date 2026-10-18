

<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'guest.home')->name('home');
Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

Route::resource('pelanggan', PelangganController::class)->except(['show']);
Route::resource('produk', ProdukController::class)->except(['show']);
Route::resource('kategori', KategoriController::class)->except(['show']);
