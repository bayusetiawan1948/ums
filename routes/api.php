<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(BarangController::class)->group(function () {
    Route::get('barang/{id?}', 'getBarang');
    Route::post('barang', 'createBarang');
    Route::patch('barang/{id}', 'updateBarang');
    Route::delete('barang/{id}', 'deleteBarang');
});
Route::controller(PelangganController::class)->group(function () {
    Route::get('pelanggan/{id?}', 'getPelanggan');
    Route::post('pelanggan', 'createPelanggan');
    Route::patch('pelanggan/{id}', 'updatePelanggan');
    Route::delete('pelanggan/{id}', 'deletePelanggan');
});
Route::controller(PenjualanController::class)->group(function () {
    Route::get('penjualan/{id?}', 'getPenjualan');
    Route::post('penjualan', 'createPenjualan');
    Route::patch('penjualan/{id}', 'updatePenjualan');
    Route::delete('penjualan/{id}', 'deletePenjualan');
});