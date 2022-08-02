<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* redireccionamiento al dash */
Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('dashboard');

/* redireccionamiento a registro */
Route::get('dashboard/registro', [App\Http\Controllers\UserController::class, 'registro'])->name('registro');

/* redireccionamiento a presentacion */
Route::get('dashboard/presentacion', [App\Http\Controllers\UserController::class, 'presentacion'])->name('presentacion');

/* redireccionamiento a presentacion */
Route::get('dashboard/ausente', [App\Http\Controllers\UserController::class, 'ausente'])->name('ausente');

Route::get('dashboard/excel', [App\Http\Controllers\UserController::class, 'excel'])->name('excel');

Route::post('dashboard/excel/importar', [App\Http\Controllers\UserController::class, 'importar'])->name('importar');