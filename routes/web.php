<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyewaanPelangganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InformasiAkunController;
use Illuminate\Support\Facades\Route;

// ==================== HALAMAN UTAMA ====================
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// ==================== LOGIN ====================
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// ==================== REGISTER ====================
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// ==================== LOGOUT ====================
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==================== ADMIN ====================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', [LaporanController::class, 'dashboard'])
            ->name('dashboard');

        // Kategori barang
        Route::resource('/kategori', KategoriController::class)
            ->except(['create', 'edit', 'show'])
            ->names([
                'index' => 'kategori.index',
                'store' => 'kategori.store',
                'update' => 'kategori.update',
                'destroy' => 'kategori.destroy',
            ]);

        // Data barang
        Route::resource('/barang', BarangController::class)
            ->except(['show']);

        // Daftar penyewaan
        Route::get('/penyewaan', [PenyewaanController::class, 'index'])
            ->name('penyewaan.index');

        // Menyetujui pengajuan penyewaan
        Route::patch('/penyewaan/{id}/setujui', [PenyewaanController::class, 'setujui'])
            ->name('penyewaan.setujui');

        // Menolak pengajuan yang masih menunggu
        Route::patch('/penyewaan/{id}/tolak', [PenyewaanController::class, 'tolak'])
            ->name('penyewaan.tolak');

        // Mengonfirmasi pembayaran
        Route::patch('/penyewaan/{id}/konfirmasi-pembayaran', [PenyewaanController::class, 'konfirmasiPembayaran'])
            ->name('penyewaan.konfirmasiPembayaran');

        // Membatalkan penyewaan yang sudah dibayar sebelum tanggal sewa
        Route::patch('/penyewaan/{id}/batalkan', [PenyewaanController::class, 'batalkan'])
            ->name('penyewaan.batalkan');

        // Mengonfirmasi pengembalian barang
        Route::patch('/penyewaan/{id}/dikembalikan', [PenyewaanController::class, 'dikembalikan'])
            ->name('penyewaan.dikembalikan');

        // Halaman laporan
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');
    });

// ==================== PELANGGAN DAN AKUN ====================
Route::middleware('auth')->group(function () {

    // Informasi akun
    Route::get('/informasi-akun', [InformasiAkunController::class, 'index'])
        ->name('akun.index');

    Route::get('/informasi-akun/edit', [InformasiAkunController::class, 'edit'])
        ->name('akun.edit');

    Route::put('/informasi-akun', [InformasiAkunController::class, 'update'])
        ->name('akun.update');

    Route::get('/informasi-akun/password', [InformasiAkunController::class, 'editPassword'])
        ->name('akun.password');

    Route::put('/informasi-akun/password', [InformasiAkunController::class, 'updatePassword'])
        ->name('akun.password.update');

    // Form penyewaan pelanggan
    Route::get('/sewa/{id_barang}', [PenyewaanPelangganController::class, 'create'])
        ->name('penyewaan.create');

    Route::post('/sewa/{id_barang}', [PenyewaanPelangganController::class, 'store'])
        ->name('penyewaan.store');

    // Riwayat penyewaan: hanya untuk melihat status
    Route::get('/riwayat-penyewaan', [PenyewaanPelangganController::class, 'riwayat'])
        ->name('penyewaan.riwayat');
});