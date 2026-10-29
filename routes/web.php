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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [LaporanController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('/kategori', KategoriController::class)
            ->except(['create', 'edit', 'show'])
            ->names([
                'index' => 'kategori.index',
                'store' => 'kategori.store',
                'update' => 'kategori.update',
                'destroy' => 'kategori.destroy',
            ]);

        Route::resource('/barang', BarangController::class)
            ->except(['show']);

        Route::get('/penyewaan', [PenyewaanController::class, 'index'])
            ->name('penyewaan.index');

        Route::patch('/penyewaan/{id}/setujui', [PenyewaanController::class, 'setujui'])
            ->name('penyewaan.setujui');

        Route::patch('/penyewaan/{id}/tolak', [PenyewaanController::class, 'tolak'])
            ->name('penyewaan.tolak');

        Route::patch('/penyewaan/{id}/konfirmasi-pembayaran', [PenyewaanController::class, 'konfirmasiPembayaran'])
            ->name('penyewaan.konfirmasiPembayaran');

        Route::patch('/penyewaan/{id}/batalkan', [PenyewaanController::class, 'batalkan'])
            ->name('penyewaan.batalkan');

        Route::patch('/penyewaan/{id}/dikembalikan', [PenyewaanController::class, 'dikembalikan'])
            ->name('penyewaan.dikembalikan');

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');
    });

Route::middleware('auth')->group(function () {

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

    Route::get('/sewa/{id_barang}', [PenyewaanPelangganController::class, 'create'])
        ->name('penyewaan.create');

    Route::post('/sewa/{id_barang}', [PenyewaanPelangganController::class, 'store'])
        ->name('penyewaan.store');

    Route::get('/riwayat-penyewaan', [PenyewaanPelangganController::class, 'riwayat'])
        ->name('penyewaan.riwayat');
});