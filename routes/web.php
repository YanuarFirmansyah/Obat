<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::get('/memeriksa', [DokterController::class, 'indexDokter'])->name('dokter.index');
    Route::get('/dokter/periksa/{id}', [DokterController::class, 'formPeriksa'])->name('dokter.periksa.form');
    Route::post('/dokter/periksa/{id}', [DokterController::class, 'simpanPeriksa'])->name('dokter.periksa.simpan');
    Route::get('/dokter/periksa/{id}/edit', [DokterController::class, 'formEditPeriksa'])->name('dokter.edit.form');
    Route::put('/dokter/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.periksa.update');
});

Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::post('/pasien/periksa', [DokterController::class, 'storePeriksa'])->name('pasien.store');
    Route::get('/periksa', [DokterController::class, 'indexPasien'])->name('pasien.index');
});