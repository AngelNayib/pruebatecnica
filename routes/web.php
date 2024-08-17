<?php

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

Route::get('/', function () {
    return view('producto.index');
});

Route::get('/producto', [ProductController::class, 'index'])->name('producto.index');
Route::get('/producto/create', [ProductController::class, 'create'])->name('producto.create');
Route::post('/producto/store', [ProductController::class, 'store'])->name('producto.store');
Route::get('/producto/{product}/edit', [ProductController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{product}', [ProductController::class, 'update'])->name('producto.update');
Route::delete('/producto/{product}', [ProductController::class, 'destroy'])->name('producto.destroy');
