<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyewaanPelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/kategori', KategoriController::class);

    Route::resource('/admin/barang', BarangController::class)->except(['show']);

    Route::get('/admin/penyewaan', [PenyewaanController::class, 'index'])
    ->name('admin.penyewaan.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/sewa/{id_barang}', [PenyewaanPelangganController::class, 'create'])
        ->name('penyewaan.create');

    Route::post('/sewa/{id_barang}', [PenyewaanPelangganController::class, 'store'])
        ->name('penyewaan.store');
});