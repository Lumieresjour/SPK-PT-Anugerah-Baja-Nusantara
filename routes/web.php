
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\KalkulasiController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

// Protected Routes
Route::middleware('auth.session')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('/perusahaan', PerusahaanController::class)->except(['show']);
    Route::resource('/kriteria', KriteriaController::class)->except(['show']);
    Route::resource('/klasifikasi', KlasifikasiController::class)->except(['show']);
    Route::resource('/evaluasi', EvaluasiController::class)->except(['show']);
    
    Route::get('/kalkulasi', [KalkulasiController::class, 'index'])->name('kalkulasi.index');
    Route::post('/kalkulasi/calculate', [KalkulasiController::class, 'calculate'])->name('kalkulasi.calculate');
    Route::get('/kalkulasi/export-pdf', [KalkulasiController::class, 'exportPdf'])->name('kalkulasi.pdf');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return redirect('/login');
});