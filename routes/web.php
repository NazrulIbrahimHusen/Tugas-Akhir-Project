<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PublicController;

// ================================
// PUBLIK
// ================================
Route::get('/',          [PublicController::class, 'home'])->name('home');
Route::get('/daftar',    [PublicController::class, 'formDaftar'])->name('public.daftar');
Route::post('/daftar',   [PublicController::class, 'simpanDaftar'])->name('public.simpan');
Route::get('/pendaftar', [PublicController::class, 'listSiswa'])->name('public.list');
Route::get('/sukses/{no}', [PublicController::class, 'sukses'])->name('public.sukses');

// ================================
// AUTH
// ================================
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================================
// ADMIN (wajib login)
// ================================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD siswa
    Route::resource('siswa', SiswaController::class);
    Route::get('/siswa-print',  [SiswaController::class, 'print'])->name('siswa.print');
    Route::get('/siswa-export', [SiswaController::class, 'exportExcel'])->name('siswa.export');

    // Ganti password
    Route::get('/ganti-password',  [AuthController::class, 'showGantiPassword'])->name('ganti.password');
    Route::post('/ganti-password', [AuthController::class, 'gantiPassword'])->name('ganti.password.post');
});
