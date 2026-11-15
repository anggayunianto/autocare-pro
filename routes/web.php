<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BengkelController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [BengkelController::class, 'dashboard'])->name('dashboard');

Route::get('/kendaraan', [BengkelController::class, 'kendaraan'])->name('kendaraan.index');
Route::post('/kendaraan', [BengkelController::class, 'simpanKendaraan'])->name('kendaraan.store');

Route::get('/antrian', [BengkelController::class, 'antrian'])->name('antrian.index');
Route::post('/antrian', [BengkelController::class, 'simpanAntrian'])->name('antrian.store');
Route::patch('/antrian/{id}/status', [BengkelController::class, 'updateStatusAntrian'])->name('antrian.status');

Route::get('/laporan', [BengkelController::class, 'laporan'])->name('laporan.index');