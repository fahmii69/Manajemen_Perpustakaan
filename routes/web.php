<?php

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

Route::get('/',[SiswaController::class,'index'])->name('index');
Route::get('/list',[SiswaController::class,'getSiswa'])->name('siswa.list');


Route::group([
    'prefix' => 'siswa',
    'as' => 'siswa.',
], function () {
Route::get('/',[SiswaController::class,'indexSiswa'])->name('index');
Route::get('/create',[SiswaController::class,'create'])->name('create');
Route::get('/edit/{siswa}',[SiswaController::class,'edit'])->name('edit');

Route::post('/create', [SiswaController::class, 'store'])->name('store');
Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('delete');
Route::patch('/edit/{siswa}',[SiswaController::class,'update'])->name('update');
});




