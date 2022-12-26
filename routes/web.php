<?php

use App\Http\Controllers\Buku\BukuController;
use App\Http\Controllers\Buku\KategoriBukuController;
use App\Http\Controllers\Buku\PenerbitBukuController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Transaksi\LaporanController;
use App\Http\Controllers\Transaksi\PeminjamanController;
use App\Http\Controllers\Transaksi\PengembalianController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['auth:sanctum', 'guestOrVerify'],
], function () {

    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/list', [SiswaController::class, 'getSiswa'])->name('siswa.list');

    Route::get('/buku/get', [BukuController::class, 'getBuku'])->name('buku.list');
    Route::resource('/buku', BukuController::class);

    Route::get('/peminjaman/get', [PeminjamanController::class, 'getPeminjaman'])->name('peminjaman.list');
    Route::resource('/peminjaman', PeminjamanController::class);

    Route::get('/pengembalian/get', [PengembalianController::class, 'getPengembalian'])->name('pengembalian.list');
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/hilang', [LaporanController::class, 'indexBukuHilang'])->name('laporan.hilang.index');
    Route::get('/laporan/hilang/data', [LaporanController::class, 'getBukuHilang'])->name('laporan.hilang.list');

    Route::get('/about', [IdentitasController::class, 'index']);
    Route::patch('/about', [IdentitasController::class, 'update'])->name('about.update');

    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('isAdmin')->group(function () {
        Route::get('/penerbit/get', [PenerbitBukuController::class, 'getPenerbit'])->name('penerbit.list');
        Route::resource('/penerbit', PenerbitBukuController::class);

        Route::get('/kategori/get', [KategoriBukuController::class, 'getKategori'])->name('kategori.list');
        Route::resource('/kategori', KategoriBukuController::class);

        Route::get('/pengembalian/{pengembalian}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
        Route::patch('/pengembalian/{pengembalian}', [PengembalianController::class, 'pengembalianBuku'])->name('pengembalian.update');

        Route::group([
            'prefix' => 'siswa',
            'as' => 'siswa.',
        ], function () {
            Route::get('/', [SiswaController::class, 'indexSiswa'])->name('index');
            Route::get('/create', [SiswaController::class, 'create'])->name('create');
            Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');

            Route::post('/create', [SiswaController::class, 'store'])->name('store');
            Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('delete');
            Route::patch('/{siswa}/edit', [SiswaController::class, 'update'])->name('update');
        });
    });
});


require __DIR__ . '/auth.php';
