<?php

use App\Http\Controllers\BarangController;
use App\Models\Pelanggan;
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
    Route::get('barang/id?', 'getAllBarang');
    Route::post('barang', 'createBarang');
    Route::patch('barang/{id}', 'updateBarang');
    Route::delete('barang/{id}', 'deleteBarang');
});
Route::controller(Pelanggan::class)->group(function () {
    Route::get('pelanggan/id?', 'getAllPelanggan');
    Route::post('pelanggan', 'createPelanggan');
    Route::patch('pelanggan/{id}', 'updatePelanggan');
    Route::delete('pelanggan/{id}', 'deletePelanggan');
});