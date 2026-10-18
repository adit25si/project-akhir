

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

// route lain tetap dipertahankan

Route::resource('pelanggan', PelangganController::class);
