<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BahanBakuController;
use App\Http\Controllers\Api\DetailTransaksiController;
use App\Http\Controllers\Api\PenitipController;
use App\Http\Controllers\Api\TransaksiBahanBakuController;
use App\Http\Controllers\Api\HistoriPesananController;
use App\Http\Controllers\Api\PengeluaranLainController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('api')->group(function () {
    Route::get('/bahanbakus',[App\Http\Controllers\Api\BahanBakuController::class,'index']);
    Route::post('/bahanbakus',[App\Http\Controllers\Api\BahanBakuController::class,'store']);
    Route::get('/bahanbakus/{nama_bahan}',[App\Http\Controllers\Api\BahanBakuController::class,'show']);
    Route::put('/bahanbakus/{id}',[App\Http\Controllers\Api\BahanBakuController::class,'update']);
    Route::delete('/bahanbakus/{id}',[App\Http\Controllers\Api\BahanBakuController::class,'destroy']);

    Route::get('/detailtransaksis',[App\Http\Controllers\Api\DetailTransaksiController::class,'index']);
    Route::post('/detailtransaksis',[App\Http\Controllers\Api\DetailTransaksiController::class,'store']);
    Route::get('/detailtransaksis/{id}',[App\Http\Controllers\Api\DetailTransaksiController::class,'show']);
    Route::put('/detailtransaksis/{id}',[App\Http\Controllers\Api\DetailTransaksiController::class,'update']);
    Route::delete('/detailtransaksis/{id}',[App\Http\Controllers\Api\DetailTransaksiController::class,'destroy']);

    Route::get('/penitips',[App\Http\Controllers\Api\PenitipController::class,'index']);
    Route::post('/penitips',[App\Http\Controllers\Api\PenitipController::class,'store']);
    Route::get('/penitips/{nama_penitip}',[App\Http\Controllers\Api\PenitipController::class,'show']);
    Route::put('/penitips/{id}',[App\Http\Controllers\Api\PenitipController::class,'update']);
    Route::delete('/penitips/{id}',[App\Http\Controllers\Api\PenitipController::class,'destroy']);

    Route::get('/pengeluaranlains',[App\Http\Controllers\Api\PengeluaranLainController::class,'index']);
    Route::post('/pengeluaranlains',[App\Http\Controllers\Api\PengeluaranLainController::class,'store']);
    Route::get('/pengeluaranlains/{tanggal_pengeluaran}', [App\Http\Controllers\Api\PengeluaranLainController::class, 'show'])
    ->where('tanggal_pengeluaran', '\d{4}-\d{2}-\d{2}');
    Route::put('/pengeluaranlains/{id}',[App\Http\Controllers\Api\PengeluaranLainController::class,'update']);
    Route::delete('/pengeluaranlains/{id}',[App\Http\Controllers\Api\PengeluaranLainController::class,'destroy']);

    Route::get('/customers/historipembelian', [HistoriPesananController::class, 'showHistory']);
    // Route::get('/customers/pembelian/{id}', [HistoriPesananController::class, 'showPembelian']);

    Route::get('/transaksibahanbakus',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'index']);
    Route::post('/transaksibahanbakus',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'store']);
    Route::get('/transaksibahanbakus/{id}',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'show']);
    Route::put('/transaksibahanbakus/{id}',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'update']);
    Route::delete('/transaksibahanbakus/{id}',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'destroy']);
});