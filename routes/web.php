<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PemeriksaanController;

use App\Http\Controllers\Pemilik\DasboardController as PemilikDashboardController;
use App\Http\Controllers\Pemilik\HewanController;
use App\Http\Controllers\Pemilik\RiwayatController;


use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PemesananController as AdminPemesananController;

use App\Http\Controllers\Pemilik\PemesananController;
use App\Http\Controllers\Pemilik\PembayaranController;


use App\Http\Controllers\Petugas\BillingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    Route::resource('/admin/jadwal', JadwalController::class);

    Route::get('/admin/pemesanan', [AdminPemesananController::class, 'index']);

    Route::get('/admin/pemesanan/{id}/konfirmasi', [AdminPemesananController::class, 'konfirmasi']);

    Route::get('/admin/pemesanan/{id}/batal', [AdminPemesananController::class, 'batal']);

    Route::get('/admin/pembayaran', [AdminPembayaranController::class, 'index']);

    Route::get('/admin/pembayaran/{id}/verifikasi', [AdminPembayaranController::class, 'verifikasi']);

    Route::get('/admin/pembayaran/{id}/gagal', [AdminPembayaranController::class, 'gagal']);

    Route::get(
    '/admin/pembayaran/verifikasi/{id}',
    [App\Http\Controllers\Admin\PembayaranController::class,
    'verifikasi']
    );

    Route::get(
        '/admin/pembayaran/lunas/{id}',
        [App\Http\Controllers\Admin\PembayaranController::class,
        'buatLunas']
    );

    // Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Route::get(
    //     '/pembayaran',
    //     [App\Http\Controllers\Pemilik\PembayaranController::class, 'index']
    // );

    // Route::get(
    //     '/pembayaran/{id}/verifikasi',
    //     [App\Http\Controllers\Pemilik\PembayaranController::class, 'verifikasi']
    // );

    // });

});

Route::middleware(['auth', 'petugas'])->group(function () {

                /**
             * DASHBOARD
             */

            Route::get(
                '/petugas/dashboard',
                [PetugasDashboardController::class, 'index']
            );

            /**
             * ANTRIAN PEMERIKSAAN
             */

            Route::get(
                '/petugas/pemeriksaan',
                [PemeriksaanController::class, 'index']
            );

            Route::get(
                '/petugas/pemeriksaan/{id}/create',
                [PemeriksaanController::class, 'create']
            );

            Route::post(
                '/petugas/pemeriksaan/store',
                [PemeriksaanController::class, 'store']
            );

            /**
             * HASIL PEMERIKSAAN
             */

            Route::get(
                '/petugas/hasil-pemeriksaan',
                [PemeriksaanController::class, 'hasil']
            );

            Route::get(
                '/petugas/hasil-pemeriksaan/{id}',
                [PemeriksaanController::class, 'show']
            );

            Route::get(
                '/petugas/hasil-pemeriksaan/{id}/edit',
                [PemeriksaanController::class, 'edit']
            );

            Route::put(
                '/petugas/hasil-pemeriksaan/{id}',
                [PemeriksaanController::class, 'update']
            );

            Route::delete(
                '/petugas/hasil-pemeriksaan/{id}',
                [PemeriksaanController::class, 'destroy']
            );

            /**
             * BILLING
             */

            Route::get(
                '/petugas/billing',
                [BillingController::class, 'index']
            );

            Route::get(
                '/petugas/billing/{id}/create',
                [BillingController::class, 'create']
            );

            Route::post(
                '/petugas/billing/store',
                [BillingController::class, 'store']
            );

            Route::get(
                '/petugas/billing/{id}',
                [BillingController::class, 'show']
            );

            Route::get(
                '/petugas/billing/{id}/edit',
                [BillingController::class, 'edit']
            );

            Route::put(
                '/petugas/billing/{id}',
                [BillingController::class, 'update']
            );

            Route::delete(
                '/petugas/billing/{id}',
                [BillingController::class, 'destroy']
            );

                });



Route::middleware(['auth', 'pemilik'])->group(function () {

    Route::get('/pemilik/dashboard', [PemilikDashboardController::class, 'index']);

    Route::resource('/pemilik/hewan', HewanController::class);

    Route::resource('/pemilik/pemesanan', PemesananController::class);

    Route::get('/pemilik/pembayaran', [PembayaranController::class, 'index']);

    Route::get('/pemilik/pembayaran/{id}/create', [PembayaranController::class, 'create']);

    Route::post('/pemilik/pembayaran/store', [PembayaranController::class, 'store']);

    Route::get(
        '/pemilik/riwayat',
        [RiwayatController::class, 'index']
    );

    Route::get(
    '/pemilik/pembayaran/{id}/create',
    [PembayaranController::class, 'create']
    );

    Route::put(
    '/pemilik/pembayaran/{id}',
    [PembayaranController::class, 'update']
    );

    Route::get(
    '/pemilik/pembayaran/cetak',
    [App\Http\Controllers\Pemilik\PembayaranController::class,
    'cetakPdf']
    );

    Route::get(

    '/pemilik/billing',

    [App\Http\Controllers\Pemilik\BillingController::class,
    'index']

            );

            Route::get(

                '/pemilik/billing/{id}/bayar',

                [App\Http\Controllers\Pemilik\BillingController::class,
                'bayar']

            );

            Route::put(

                '/pemilik/billing/{id}/upload',

                [App\Http\Controllers\Pemilik\BillingController::class,
                'upload']

            );

});

require __DIR__.'/auth.php';