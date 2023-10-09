<?php

use App\Http\Controllers\AuthController;
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

Route::middleware(['guest'])->group(function () { 
    Route::get('/', [AuthController::class,'index'])->name('Login');
    Route::post('/', [AuthController::class,'login']);
});

Route::get('/home', function() {
    return redirect('');
});

Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard')->middleware('user:admin,operator')->group(function () {
        Route::get('/surat', [ControllerDashboard::class,'index']);
        Route::get('/surat/tambah', [ControllerDashboard::class,'create']);
        Route::post('/surat/simpan', [ControllerDashboard::class,'store']);
        Route::get('/surat/edit/{id}', [ControllerDashboard::class,'edit']);
        Route::post('/surat/update', [ControllerDashboard::class,'update']);
        Route::delete('/surat/hapus/', [ControllerDashboard::class,'destroy']);
    });

    Route::prefix('jenis-surat')->middleware('user:admin')->group(function () {
        Route::get('/surat', [ControllerManagemenJenisSurat::class,'index']);
        Route::get('/surat/tambah', [ControllerManagemenJenisSurat::class,'create']);
        Route::post('/surat/simpan', [ControllerManagemenJenisSurat::class,'store']);
        Route::get('/surat/edit/{id}', [ControllerManagemenJenisSurat::class,'edit']);
        Route::post('/surat/update', [ControllerManagemenJenisSurat::class,'update']);
        Route::delete('/surat/hapus/', [ControllerManagemenJenisSurat::class,'destroy']);
    });

    Route::prefix('managemen-user')->middleware('user:admin')->group(function () {
        Route::get('/user', [ControllerManagemenUser::class,'index']);
        Route::get('/user/tambah', [ControllerManagemenUser::class,'create']);
        Route::post('/user/simpan', [ControllerManagemenUser::class,'store']);
        Route::get('/user/edit/{id}', [ControllerManagemenUser::class,'edit']);
        Route::post('/user/update', [ControllerManagemenUser::class,'update']);
        Route::delete('/user/hapus/', [ControllerManagemenUser::class,'destroy']);
    });

    Route::get('/transaksi-surat', [ControllerTransaksiSurat::class,'index'])->middleware('user:admin,operator')->name('TransaksiSurat');
   

    Route::get("logout", [AuthController::class, 'logout']);
});





