<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

// Route root (/) tampilkan halaman authhome tanpa middleware apapun
Route::get('/', function () {
    return view('authhome');
});

// Route root (/) redirect ke dashboard jika sudah login, jika belum ke login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth', 'role:dokter'])->group(function () {
    // Profil Dokter
    Route::get('/dokter/profil', [DokterController::class, 'profil'])->name('dokter.profil');
    Route::put('/dokter/profil', [DokterController::class, 'updateProfil'])->name('dokter.profil.update');
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::get('/memeriksa', [DokterController::class, 'indexDokter'])->name('memeriksa.index');
    Route::get('/riwayat-pasien', [\App\Http\Controllers\RiwayatPasienController::class, 'index'])->name('riwayat_pasien.index');
    Route::get('/dokter/periksa/{id}', [DokterController::class, 'formPeriksa'])->name('dokter.periksa.form');
    Route::post('/dokter/periksa/{id}', [DokterController::class, 'simpanPeriksa'])->name('dokter.periksa.simpan');
    Route::get('/dokter/periksa/{id}/edit', [DokterController::class, 'formEditPeriksa'])->name('dokter.edit.form');
    Route::put('/dokter/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.periksa.update');

    // Jadwal Periksa Dokter
    Route::get('/jadwal-periksa', [\App\Http\Controllers\JadwalPeriksaController::class, 'index'])->name('jadwal_periksa.index');
    Route::get('/jadwal-periksa/create', [\App\Http\Controllers\JadwalPeriksaController::class, 'create'])->name('jadwal_periksa.create');
    Route::post('/jadwal-periksa', [\App\Http\Controllers\JadwalPeriksaController::class, 'store'])->name('jadwal_periksa.store');
    Route::get('/jadwal-periksa/{id}/edit', [\App\Http\Controllers\JadwalPeriksaController::class, 'edit'])->name('jadwal_periksa.edit');
    Route::put('/jadwal-periksa/{id}', [\App\Http\Controllers\JadwalPeriksaController::class, 'update'])->name('jadwal_periksa.update');
    Route::delete('/jadwal-periksa/{id}', [\App\Http\Controllers\JadwalPeriksaController::class, 'destroy'])->name('jadwal_periksa.destroy');
});

// Route khusus pasien untuk daftar periksa
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/periksa', [DokterController::class, 'indexPasien'])->name('pasien.periksa.form');
    Route::post('/periksa', [DokterController::class, 'storePeriksa'])->name('pasien.periksa.store');
});

// Route khusus admin untuk CRUD Obat, Dokter, Pasien, dan Poli
Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD Obat
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');

    // CRUD Dokter
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');

    // CRUD Pasien
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    // CRUD Poli
    Route::get('/poli', [App\Http\Controllers\PoliController::class, 'index'])->name('poli.index');
    Route::get('/poli/create', [App\Http\Controllers\PoliController::class, 'create'])->name('poli.create');
    Route::post('/poli', [App\Http\Controllers\PoliController::class, 'store'])->name('poli.store');
    Route::get('/poli/{id}/edit', [App\Http\Controllers\PoliController::class, 'edit'])->name('poli.edit');
    Route::put('/poli/{id}', [App\Http\Controllers\PoliController::class, 'update'])->name('poli.update');
    Route::delete('/poli/{id}', [App\Http\Controllers\PoliController::class, 'destroy'])->name('poli.destroy');
});