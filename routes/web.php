<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\RekananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapAbsenController;

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RekananController as AdminRekananController;
use App\Http\Controllers\Admin\RekapAbsenController as AdminRekapAbsenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest'])->group(function () {
    Route::resource('rekanans', RekananController::class)->only(['index', 'store']);
    Route::post('rekanans/download', [RekananController::class, 'download'])->name('rekanans.download');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::resource('absens', AbsenController::class)->only(['index', 'store']);

    Route::resource('rekaps', RekapAbsenController::class)->only(['index', 'update']);
    Route::post('rekaps/download', [RekapAbsenController::class, 'download'])->name('rekaps.download');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [AdminProfileController::class, 'update'])->name('profile.update');

    Route::resource('users', AdminUserController::class);
    Route::post('users/download', [AdminUserController::class, 'download'])->name('users.download');

    Route::resource('rekanans', AdminRekananController::class);
    Route::post('rekanans/download', [AdminRekananController::class, 'download'])->name('rekanans.download');

    Route::resource('tknos', AdminRekapAbsenController::class);
    Route::post('tknos/download', [AdminRekapAbsenController::class, 'download'])->name('tknos.download');
});


require __DIR__ . '/auth.php';
