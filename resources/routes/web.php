<?php

use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerManagemenJenisSurat;
use App\Http\Controllers\ControllerManagemenUser;
use App\Http\Controllers\ControllerTransaksiSurat;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/')->group(function(){
    Route::get('/dashboard', [ControllerDashboard::class,'index'])->name('Dashhboard');

    Route::get('/managemen-jenis-surat', [ControllerManagemenJenisSurat::class,'index'])->name('ManagemenJenisSurat');
    Route::get('/managemen-jenis-surat/tambah', [ControllerManagemenJenisSurat::class,'create'])->name('ManagemenJenisSurat Create');
    Route::post('/managemen-jenis-surat/simpan', [ControllerManagemenJenisSurat::class,'store'])->name('ManagemenJenisSurat Store');
    Route::get('/managemen-jenis-surat/edit/{id}', [ControllerManagemenJenisSurat::class,'edit'])->name('ManagemenJenisSurat Edit');
    Route::post('/managemen-jenis-surat/update', [ControllerManagemenJenisSurat::class,'update'])->name('ManagemenJenisSurat Update');
    Route::get('/managemen-jenis-surat/hapus/{id}', [ControllerManagemenJenisSurat::class,'destroy'])->name('ManagemenJenisSurat Hapus');

    Route::get('/managemen-user', [ControllerManagemenUser::class,'index'])->name('ManagemenUser');
    Route::get('/managemen-user/tambah', [ControllerManagemenUser::class,'create'])->name('ManagemenUser Create');
    Route::post('/managemen-user/simpan', [ControllerManagemenUser::class,'store'])->name('ManagemenUser Store');
    Route::get('/managemen-user/edit/{id}', [ControllerManagemenUser::class,'edit'])->name('ManagemenUser Edit');
    Route::post('/managemen-user/update', [ControllerManagemenUser::class,'update'])->name('ManagemenUser Update');
    Route::get('/managemen-user/hapus/{id}', [ControllerManagemenUser::class,'destroy'])->name('ManagemenUser Hapus');

    Route::get('/transaksi-surat', [ControllerTransaksiSurat::class,'index'])->name('TransaksiSurat');
});


