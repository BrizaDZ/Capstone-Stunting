<?php

use App\Http\Controllers\Master\AdminController;
use App\Http\Controllers\Master\LokasiPuskesmasController;
use App\Http\Controllers\Master\RelationshipController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\Data\ArticleController;
use App\Http\Controllers\Data\CheckupController;
use App\Http\Controllers\Data\StuntingController;
use App\Http\Controllers\Data\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\OperationalTimeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorOperationalTimeController;
use App\Http\Controllers\StuntingExportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\MpasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\ApiExternalController;


use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('');
// });
Route::get('/chat', [ChatbotController::class, 'index']);
Route::post('/chat', [ChatbotController::class, 'ask']);
Route::get('/chat/{userId}', [DashboardController::class, 'getChatByUser']);
Route::get('/chat-users', [DashboardController::class, 'getUsersWithChat']);
Route::post('/chat-store', [DashboardController::class, 'storeChat']);


Route::get('/mpasi', [MpasiController::class, 'form']);
Route::post('/predict-mpasi', [MpasiController::class, 'predict']);
Route::post('/recommend-mpasi-by-age', [MpasiController::class, 'recommendByAge']);

Route::get('/predict-stunting', [PredictController::class, 'index']);
Route::post('/api/predict-stunting', [PredictController::class, 'predict']);

Route::get('/detail/article/{slug}', [ArticleController::class, 'Detail']);


Route::get('/export-stunting', [StuntingExportController::class, 'export'])->name('export.stunting');

//api external
Route::get('/api/provinces', [ApiExternalController::class, 'getProvinces']);
Route::get('/api/regencies/{id}', [ApiExternalController::class, 'getRegencies']);
Route::get('/api/districts/{id}', [ApiExternalController::class, 'getDistricts']);
Route::get('/api/village/{id}', [ApiExternalController::class, 'getVillage']);

Route::get('/master/doctor/search', [DoctorController::class, 'search']);
Route::get('/master/puskesmas/search', [LokasiPuskesmasController::class, 'search']);
Route::get('/master/doctoroperationaltime/search', [DoctorOperationalTimeController::class, 'search']);
Route::get('/data/patient/search', [ProfilePatientController::class, 'searchPatient']);
Route::get('/master/relationship/search', [RelationshipController::class, 'search']);

Route::get('/surat-rujukan/download/{StuntingID}', [CheckupController::class, 'downloadPdf']);
Route::get('/appointment/print/{id}', [AppointmentController::class, 'printCard'])->name('appointment.print');




Route::middleware(['isAdmin'])->group(function () {
    // untuk route admin taro sini
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin']);
    Route::get('/puskesmas', [AdminController::class, 'index']);
    Route::prefix('/master')->group(function () {

        Route::prefix('/relationship')->group(function () {
            Route::get('/', [RelationshipController::class, 'index']);
            Route::get('/edit/{id}', [RelationshipController::class, 'Edit']);
            Route::get('/add', [RelationshipController::class, 'Add']);
            Route::post('/store', [RelationshipController::class, 'store']);
            Route::post('/delete/{id}', [RelationshipController::class, 'delete']);
            Route::post('/table', [RelationshipController::class, 'Ajax']);
        });

    });
    Route::prefix('/data')->group(function () {
        Route::prefix('/puskesmas')->group(function () {
            Route::get('/', [LokasiPuskesmasController::class, 'index']);
            Route::get('/edit/{id}', [LokasiPuskesmasController::class, 'Edit']);
            Route::get('/add', [LokasiPuskesmasController::class, 'Add']);
            Route::post('/store', [LokasiPuskesmasController::class, 'store']);
            Route::post('/delete/{id}', [LokasiPuskesmasController::class, 'delete']);
            Route::post('/table', [LokasiPuskesmasController::class, 'Ajax']);
        });
        Route::prefix('/user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/edit/{id}', [UserController::class, 'Edit']);
            Route::get('/add', [UserController::class, 'Add']);
            Route::post('/store', [UserController::class, 'store']);
            Route::post('/delete/{id}', [UserController::class, 'delete']);
            Route::post('/table', [UserController::class, 'Ajax']);
        });
        Route::prefix('/artikel')->group(function () {
            Route::get('/', [ArticleController::class, 'index']);
            Route::get('/edit/{id}', [ArticleController::class, 'Edit']);
            Route::get('/add', [ArticleController::class, 'Add']);
            Route::post('/store', [ArticleController::class, 'store']);
            Route::post('/delete/{id}', [ArticleController::class, 'delete']);
            Route::post('/table', [ArticleController::class, 'Ajax']);
        });
    });
});

Route::middleware(['isPuskesmas'])->group(function () {
    // untuk route puskesmas taro sini
    Route::get('/puskesmas/dashboard', [DashboardController::class, 'index']);

    // Route::get('/puskesmas/dashboard', [PuskesmasController::class, 'index']);
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
    Route::prefix('/data')->group(function () {
        Route::prefix('/janji-temu')->group(function () {
            Route::get('/', [CheckupController::class, 'index']);
            Route::get('/add', [CheckupController::class, 'add']);
            Route::get('/edit/{id}', [CheckupController::class, 'Edit']);
            Route::post('/store', [CheckupController::class, 'store']);
            Route::post('/delete/{id}', [CheckupController::class, 'delete']);
            Route::post('/table', [CheckupController::class, 'Ajax']);
        });
        Route::prefix('/stunting')->group(function () {
            Route::get('/', [StuntingController::class, 'index']);
            Route::get('/add', [StuntingController::class, 'Edit']);
            Route::post('/store', [StuntingController::class, 'store']);
            Route::post('/delete/{id}', [StuntingController::class, 'delete']);
            Route::post('/table', [StuntingController::class, 'Ajax']);
            Route::get('/detail/{id}', [StuntingController::class, 'Detail']);
        });
        Route::prefix('/pasien')->group(function () {
            Route::get('/', [PatientController::class, 'index']);
            Route::get('/add', [PatientController::class, 'Add']);
            Route::post('/store', [PatientController::class, 'Store']);
            Route::get('/edit/{id}', [PatientController::class, 'Edit']);
            Route::post('/delete/{id}', [PatientController::class, 'delete']);
            Route::post('/table', [PatientController::class, 'Ajax']);
        });
    });
});


// Route::get('/janji-temu', function () {
//     return view('web.appointment');
// })->middleware(['auth', 'verified'])->name('appointment');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');;

    Route::prefix('/profile')->group(function () {
        Route::get('/patient', [ProfilePatientController::class, 'index']);
        Route::get('/patient/edit/{id}', [ProfilePatientController::class, 'Edit']);
        Route::get('/patient/add', [ProfilePatientController::class, 'Add']);
        Route::post('/patient/store', [ProfilePatientController::class, 'store']);
        Route::post('/patient/storedetail', [ProfilePatientController::class, 'storedetail']);
        // Route::post('/delete/{id}', [LokasiPuskesmasController::class, 'delete']);
        Route::post('/patient/table', [ProfilePatientController::class, 'Ajax']);
        Route::post('/patient/table-result', [ProfilePatientController::class, 'Ajax2']);
        Route::get('/search', [ProfilePatientController::class, 'search']);
    });

    Route::prefix('/janji-temu')->group(function () {
        Route::get('/', [AppointmentController::class, 'index']);
        // Route::get('/edit/{id}', [LokasiPuskesmasController::class, 'Edit']);
        Route::get('/add', [AppointmentController::class, 'Add']);
        Route::post('/store', [AppointmentController::class, 'store']);
        // Route::post('/delete/{id}', [LokasiPuskesmasController::class, 'delete']);
        Route::post('/table', [AppointmentController::class, 'Ajax']);
        Route::get('/search', [AppointmentController::class, 'search']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
