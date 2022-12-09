<?php

use App\Http\Controllers\Buku\KategoriBukuController;
use App\Http\Controllers\Buku\PenerbitBukuController;
use App\Http\Controllers\Siswa\SiswaController;
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

Route::get('/', [SiswaController::class, 'index'])->name('index');
Route::get('/list', [SiswaController::class, 'getSiswa'])->name('siswa.list');


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

Route::get('/penerbit/get', [PenerbitBukuController::class, 'getPenerbit'])->name('penerbit.list');
Route::resource('/penerbit', PenerbitBukuController::class);

Route::get('/kategori/get', [KategoriBukuController::class, 'getKategori'])->name('kategori.list');
Route::resource('/kategori', KategoriBukuController::class);
