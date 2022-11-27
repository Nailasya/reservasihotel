<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/data_kamar', [KamarController::class, 'index']);
Route::get('/data_kamar/{id}', [KamarController::class, 'show']);

Route::middleware('auth:sanctum')->group(function (){
    // yang private untuk admin
    Route::post('/data_kamar', [KamarController::class, 'store']);
    Route::put('/data_kamar/{id}', [KamarController::class, 'update']);
    Route::delete('/data_kamar/{id}', [KamarController::class, 'destroy']);
    Route::get('/reservasi/{id}', [ReservasiController::class, 'index']);

    // get reservasi bagi customer & admin
    Route::get('/reservasi', [ReservasiController::class, 'index']);


    // menambah reservasi bagian customer
    Route::post('/reservasi', [ReservasiController::class, 'store']);

    // edit atau  reservasi bagi customer
    Route::put('/reservasi/{id}', [ReservasiController::class, 'update']);


    // delete reservasi bagi customer & admin
    Route::delete('/reservasi/{id}', [ReservasiController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
