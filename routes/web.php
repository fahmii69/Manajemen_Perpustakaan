<?php

use App\Http\Controllers\Buku\BukuController;
use App\Http\Controllers\Buku\KategoriBukuController;
use App\Http\Controllers\Buku\PenerbitBukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\SiswaController;
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

route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/list', [SiswaController::class, 'getSiswa'])->name('siswa.list');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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



Route::get('/penerbit/get', [PenerbitBukuController::class, 'getPenerbit'])->name('penerbit.list');
Route::resource('/penerbit', PenerbitBukuController::class);

Route::get('/kategori/get', [KategoriBukuController::class, 'getKategori'])->name('kategori.list');
Route::resource('/kategori', KategoriBukuController::class);

Route::get('/buku/get', [BukuController::class, 'getBuku'])->name('buku.list');
Route::resource('/buku', BukuController::class);

Route::get('/peminjaman/get', [PeminjamanController::class, 'getPeminjaman'])->name('peminjaman.list');
Route::resource('/peminjaman', PeminjamanController::class);

Route::get('/pengembalian/get', [PengembalianController::class, 'getPengembalian'])->name('pengembalian.list');
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/{pengembalian}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::patch('/pengembalian/{pengembalian}', [PengembalianController::class, 'pengembalianBuku'])->name('pengembalian.update');

// Route::get('', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
});

require __DIR__ . '/auth.php';
