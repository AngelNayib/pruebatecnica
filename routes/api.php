<?php

use App\Http\Controllers\Api\v1\ProductoController;
use App\Http\Controllers\Auth\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('v1/auth/login', [AuthController::class, 'loginApi']);
Route::middleware('auth:sanctum')->prefix('v1')->name('producto.')->controller(ProductoController::class)->group(function () {
    Route::apiResource('/productos', ProductoController::class);
});
