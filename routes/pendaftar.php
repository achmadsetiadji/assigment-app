<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    DashboardController,
};

use App\Http\Controllers\Pendaftar\{
    BiodataController,
    RiwayatPendidikanController,
    RiwayatPelatihanController,
    RiwayatPekerjaanController
};

Route::group([
    'prefix' => 'pendaftar',
    'middleware' => 'role:pendaftar',
    'as' => 'pendaftar.'
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Biodata
    Route::resource('/biodata', BiodataController::class);

    Route::middleware(['validasi_biodata'])->group(function () {
        Route::get('riwayat_pendidikan/data', [RiwayatPendidikanController::class, 'data'])->name('riwayat_pendidikan.data');
        Route::resource('riwayat_pendidikan', RiwayatPendidikanController::class)->except('create', 'edit');

        Route::get('riwayat_pelatihan/data', [RiwayatPelatihanController::class, 'data'])->name('riwayat_pelatihan.data');
        Route::resource('riwayat_pelatihan', RiwayatPelatihanController::class)->except('create', 'edit');

        Route::get('riwayat_pekerjaan/data', [RiwayatPekerjaanController::class, 'data'])->name('riwayat_pekerjaan.data');
        Route::resource('riwayat_pekerjaan', RiwayatPekerjaanController::class)->except('create', 'edit');
    });
});
