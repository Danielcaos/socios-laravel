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


Route::group(['prefix' => 'administrador/', 'middleware' => ['role:admin', 'auth']], function () {
    Route::get('/inicio', [App\Http\Controllers\AdminController::class, 'index'])->name('inicio');
    Route::get('dashboard/excel', [App\Http\Controllers\AdminController::class, 'index_excel'])->name('excel');
    Route::get('dashboard/usuario', [App\Http\Controllers\AdminController::class, 'index_usuario'])->name('usuario');

    Route::post('dashboard/excel/importar', [App\Http\Controllers\AdminController::class, 'importar'])->name('importar.excel');
    Route::post('dashboard/registro', [App\Http\Controllers\AdminController::class, 'registro'])->name('registro.admin');
});

Route::group(['prefix' => 'usuario/', 'middleware' => ['role:user', 'auth']], function () {


    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('dashboard');
    Route::get('dashboard/registro', [App\Http\Controllers\UserController::class, 'index_registro'])->name('registro');
    Route::get('dashboard/presentacion', [App\Http\Controllers\PresentacionController::class, 'index_presentacion'])->name('presentacion');
    Route::get('dashboard/ausente', [App\Http\Controllers\UserController::class, 'index_ausente'])->name('ausente');

    Route::post('dashboard/registro', [App\Http\Controllers\UserController::class, 'registro'])->name('registro.user');
    Route::post('dashboard/presentacion', [App\Http\Controllers\PresentacionController::class, 'registro'])->name('registro.presentacion');

});