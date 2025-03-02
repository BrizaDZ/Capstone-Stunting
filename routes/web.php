<?php

use App\Http\Controllers\Master\AdminController;
use App\Http\Controllers\Master\LokasiPuskesmasController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OperationalTimeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorOperationalTimeController;
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
    Route::prefix('/data')->group(function () {
        Route::prefix('/user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/edit/{id}', [UserController::class, 'Edit']);
            Route::get('/add', [UserController::class, 'Add']);
            Route::post('/store', [UserController::class, 'store']);
            Route::post('/delete/{id}', [UserController::class, 'delete']);
            Route::post('/table', [UserController::class, 'Ajax']);
        });
    });
});

Route::middleware(['isPuskesmas'])->group(function () {
    // untuk route puskesmas taro sini
    Route::get('/puskesmas/dashboard', [PuskesmasController::class, 'index']);
    Route::prefix('/master')->group(function () {
        Route::prefix('/operationaltime')->group(function () {
            Route::get('/', [OperationalTimeController::class, 'index']);
            Route::get('/edit/{id}', [OperationalTimeController::class, 'Edit']);
            Route::get('/add', [OperationalTimeController::class, 'Add']);
            Route::post('/store', [OperationalTimeController::class, 'store']);
            Route::post('/delete/{id}', [OperationalTimeController::class, 'delete']);
            Route::post('/table', [OperationalTimeController::class, 'Ajax']);
            Route::get('/search', [OperationalTimeController::class, 'search']);
        });
        Route::prefix('/doctor')->group(function () {
            Route::get('/', [DoctorController::class, 'index']);
            Route::get('/edit/{id}', [DoctorController::class, 'Edit']);
            Route::get('/add', [DoctorController::class, 'Add']);
            Route::post('/store', [DoctorController::class, 'store']);
            Route::get('/search', [DoctorController::class, 'search']);
            Route::post('/delete/{id}', [DoctorController::class, 'delete']);
            Route::post('/table', [DoctorController::class, 'Ajax']);
        });
        Route::prefix('/doctoroperationaltime')->group(function () {
            Route::get('/', [DoctorOperationalTimeController::class, 'index']);
            Route::get('/edit/{id}', [DoctorOperationalTimeController::class, 'Edit']);
            Route::get('/add', [DoctorOperationalTimeController::class, 'Add']);
            Route::post('/store', [DoctorOperationalTimeController::class, 'store']);
            Route::post('/delete/{id}', [DoctorOperationalTimeController::class, 'delete']);
            Route::post('/table', [DoctorOperationalTimeController::class, 'Ajax']);
        });
    });
});

Route::get('/', function () {
    return view('web.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/janji-temu', function () {
    return view('web.appointment');
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
