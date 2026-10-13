<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\HonorController;
use App\Http\Controllers\DataPelaksanaController;
use App\Http\Controllers\InputLaporanController;
use App\Http\Controllers\InputMutasiController;
use App\Http\Controllers\InputHonorKonsultanController;
use App\Http\Controllers\InputHonorPanitiaPetukangController;
use App\Http\Controllers\InputBelanjaMaterialController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\CetakLaporanController;
use App\Http\Controllers\KegiatanController;

Route::controller(LoginController::class)->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', 'index')->middleware('guest')->name('login');
        Route::post('/', 'login')->middleware('guest');
    });
    Route::get('/logout', 'logout')->middleware('auth');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/satuan', SatuanController::class)->except('show')->middleware('auth');
Route::resource('/toko', TokoController::class)->except('show')->middleware('auth');
Route::resource('/honor', HonorController::class)->except('show')->middleware('auth');
Route::get('/honor/update_input_laporan/{id}', [HonorController::class, 'updateInputLaporan'])->middleware('auth');
Route::resource('/data_pelaksana', DataPelaksanaController::class)->except('show')->middleware('auth');
Route::get('/data_pelaksana/update_input_laporan/{id}', [DataPelaksanaController::class, 'updateInputLaporan'])->middleware('auth');

Route::prefix('/input_laporan')->group(function () {
    Route::controller(InputLaporanController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth');
        Route::delete('/{input_laporan}', 'destroy')->middleware('auth');
        Route::get('/get_no_bukti/{mutasi}/{metode_pembayaran}', 'get_no_bukti')->middleware('auth');
    });
    Route::controller(InputMutasiController::class)->group(function () {
        Route::prefix('/mutasi')->group(function () {
            Route::get('/', 'add_mutasi')->middleware('auth');
            Route::post('/', 'save_mutasi')->middleware('auth');
            Route::get('/{input_laporan}/edit_mutasi', 'edit_mutasi')->middleware('auth');
            Route::put('/{input_laporan}', 'update_mutasi')->middleware('auth');
        });
    });
    Route::controller(InputHonorKonsultanController::class)->group(function () {
        Route::prefix('/honor_konsultan')->group(function () {
            Route::get('/', 'add_honor_konsultan')->middleware('auth');
            Route::post('/', 'save_honor_konsultan')->middleware('auth');
            Route::get('/{input_laporan}/edit_honor_konsultan', 'edit_honor_konsultan')->middleware('auth');
            Route::put('/{input_laporan}', 'update_honor_konsultan')->middleware('auth');
        });
    });
    Route::controller(InputHonorPanitiaPetukangController::class)->group(function () {
        Route::prefix('/honor_panitia_petukang')->group(function () {
            Route::get('/', 'add_honor_panitia_petukang')->middleware('auth');
            Route::post('/', 'save_honor_panitia_petukang')->middleware('auth');
            Route::get('/{input_laporan}/edit_honor_panitia_petukang', 'edit_honor_panitia_petukang')->middleware('auth');
            Route::put('/{input_laporan}', 'update_honor_panitia_petukang')->middleware('auth');
        });
    });
    Route::controller(InputBelanjaMaterialController::class)->group(function () {
        Route::prefix('/belanja_material')->group(function () {
            Route::get('/', 'add_belanja_material')->middleware('auth');
            Route::post('/', 'save_belanja_material')->middleware('auth');
            Route::get('/{input_laporan}/edit_belanja_material', 'edit_belanja_material')->middleware('auth');
            Route::put('/{input_laporan}', 'update_belanja_material')->middleware('auth');
        });
    });
});

Route::controller(CetakLaporanController::class)->group(function () {
    Route::prefix('/cetak_laporan')->group(function () {
        Route::get('/', 'index')->middleware('auth');
        Route::get('/bku', 'cetak_bku')->middleware('auth');
        Route::get('/bb', 'cetak_bb')->middleware('auth');
        Route::get('/bkt', 'cetak_bkt')->middleware('auth');
        Route::get('/daftar_hadir/{status}', 'cetak_daftar_hadir')->middleware('auth');
        Route::get('/honorarium/{status}', 'cetak_honorarium')->middleware('auth');
        Route::get('/nota_belanja', 'nota_belanja')->middleware('auth');
    });
});

Route::get('/cek', [MasterDataController::class, 'getDataPanitia']);

Route::controller(KegiatanController::class)->group(function () {
    Route::prefix('/kegiatan')->group(function () {
        Route::get('/', 'index')->middleware('auth');
        Route::post('/', 'create')->middleware('auth');
        Route::put('/{kegiatan}', 'update')->middleware('auth');
    });
});