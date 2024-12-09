<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KibController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\SpdRinciController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function() {
    Route::resource('modal', ModalController::class);
    Route::resource('kib', KibController::class);
    Route::get('ls', [SpdRinciController::class, 'index'])->name('ls.index');
    Route::post('/kib/upload', [KibController::class, 'upload'])->name('kib.upload');
    Route::get('/kib/{id}/generate-qr', [KibController::class, 'generateQrCode'])->name('kib.generate.qr');
    Route::get('/kib/export', [KibController::class, 'export'])->name('kib.export');
    Route::get('home', [DashboardController::class, 'index'])->name('home');
});
