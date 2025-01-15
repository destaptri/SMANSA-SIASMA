<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\DataAlumniController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
});


// Middleware untuk semua pengguna yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Middleware untuk role alumni
Route::middleware(['auth', 'role:Alumni'])->group(function () {
    // Biodata - hanya dapat diakses oleh role alumni
    Route::get('/biodata', [BiodataController::class, 'show'])->name('alumni.biodata');
    Route::post('/biodata', [BiodataController::class, 'update'])->name('alumni.biodata.update');
});

// Middleware untuk role admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/pencarian-data', function () {
        return view('admin.pencarian-data');
    })->name('pencarian-data');
    Route::get('/pencarian-data', [DataAlumniController::class, 'index'])->name('pencarian-data');
    Route::get('/detail-alumni/{id}', [DataAlumniController::class, 'show'])->name('detail-pencarian');
    Route::get('/validasi', function () {
        return view('admin.validasi');
    })->name('antrian-validasi');
    Route::get('/validasi', [ValidasiController::class, 'index'])->name('antrian-validasi');
    Route::get('/validasi/detail/{id}', [ValidasiController::class, 'show'])->name('detail-data');
    Route::put('/validasi/{id}', [ValidasiController::class, 'update'])->name('validasi.update');
    Route::post('/admin/biodata/update/{id}', [ValidasiController::class, 'updateBiodata'])->name('admin.biodata.update');
    Route::get('/laporan', function () {
        return view('admin.laporan');
    })->name('laporan');
});

// Route lainnya yang tidak terbatas pada role tertentu
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/hasil-pencarian', function () {
    return view('guest.hasil-pencarian');
})->name('hasil-pencarian');

// Route Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/test', function () {
    return view('test');
})->name('test');

require __DIR__ . '/auth.php';