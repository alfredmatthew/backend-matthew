<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BahanBakuController;
use App\Http\Controllers\Api\DetailTransaksiController;
use App\Http\Controllers\Api\PenitipController;
use App\Http\Controllers\Api\TransaksiBahanBakuController;
use App\Http\Controllers\Api\CustomerController;

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
    Route::get('/bahanbakus/{id}',[App\Http\Controllers\Api\BahanBakuController::class,'show']);
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

    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/{nama_customer}', [CustomerController::class, 'show']);
    Route::get('customers/pembelian/{id}', [CustomerController::class, 'showPembelian']);

    Route::get('/transaksibahanbakus',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'index']);
    Route::post('/transaksibahanbakus',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'store']);
    Route::get('/transaksibahanbakus/{id}',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'show']);
    Route::put('/transaksibahanbakus/{id}',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'update']);
    Route::delete('/transaksibahanbakus/{id}',[App\Http\Controllers\Api\TransaksiBahanBakuController::class,'destroy']);
});