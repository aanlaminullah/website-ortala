<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PublikasiDataController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [LandingController::class, 'index'])->name('landing');


Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/publikasi-data', [PublikasiDataController::class, 'index'])->name('publikasi-data.index');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('publikasi-data',                            [PublikasiDataController::class, 'adminIndex'])->name('publikasi-data.index');
    Route::get('publikasi-data/create',                     [PublikasiDataController::class, 'create'])->name('publikasi-data.create');
    Route::post('publikasi-data',                           [PublikasiDataController::class, 'store'])->name('publikasi-data.store');
    Route::get('publikasi-data/{produksiBudidaya}/edit',    [PublikasiDataController::class, 'edit'])->name('publikasi-data.edit');
    Route::put('publikasi-data/{produksiBudidaya}',         [PublikasiDataController::class, 'update'])->name('publikasi-data.update');
    Route::delete('publikasi-data/{produksiBudidaya}',      [PublikasiDataController::class, 'destroy'])->name('publikasi-data.destroy');

    // Import Excel
    Route::get('publikasi-data/import',                     [PublikasiDataController::class, 'importForm'])->name('publikasi-data.import.form');
    Route::post('publikasi-data/import',                    [PublikasiDataController::class, 'importProcess'])->name('publikasi-data.import.process');
    Route::get('publikasi-data/template',                   [PublikasiDataController::class, 'downloadTemplate'])->name('publikasi-data.template');

    Route::get('announcements',                     [AnnouncementController::class, 'adminIndex'])->name('announcements.index');
    Route::get('announcements/create',              [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('announcements',                    [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('announcements/{announcement}/edit',                 [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('announcements/{announcement}',                      [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('announcements/{announcement}/remove-attachment', [AnnouncementController::class, 'removeAttachment'])->name('announcements.remove-attachment');
    Route::delete('announcements/{announcement}',                   [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard (protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
