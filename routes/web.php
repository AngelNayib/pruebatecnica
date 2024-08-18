<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
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

/* Route::get('/', function () {
    return view('producto.index');
}); */

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('auth/register', function () {
    return view('auth.register');
})->name('register');

Route::post('auth/register/user', [AuthController::class, 'register'])->name('register.user');
Route::post('auth/login/user', [AuthController::class, 'login'])->name('login.user');
Route::post('auth/logout/user', [AuthController::class, 'logout'])->name('logout.user');

Route::middleware('auth')->prefix('producto')->name('producto.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{product}/edit', 'edit')->name('edit');
    Route::put('/{product}', 'update')->name('update');
    Route::delete('/{product}', 'destroy')->name('destroy');
});
