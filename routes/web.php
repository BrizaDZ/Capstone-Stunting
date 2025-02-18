<?php

use App\Http\Controllers\Master\AdminController;
use App\Http\Controllers\Master\LokasiPuskesmasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('');
// });

Route::middleware(['isAdmin'])->group(function () {
    // untuk route admin taro sini
    Route::get('/puskesmas', [AdminController::class, 'index']);
    Route::prefix('/master')->group(function () {
        Route::prefix('/puskesmas')->group(function () {
            Route::get('/', [LokasiPuskesmasController::class, 'index']);
            Route::get('/edit/{id}', [LokasiPuskesmasController::class, 'Edit']);
            Route::get('/add', [LokasiPuskesmasController::class, 'Add']);
            Route::post('/store', [LokasiPuskesmasController::class, 'store']);
            Route::post('/delete/{id}', [LokasiPuskesmasController::class, 'delete']);
            Route::post('/table', [LokasiPuskesmasController::class, 'Ajax']);
        });
    });
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
