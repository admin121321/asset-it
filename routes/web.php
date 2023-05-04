<?php

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
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logo', [App\Http\Controllers\LogoController::class, 'index'])->name('logo.index');
Route::post('/logo/store', [App\Http\Controllers\LogoController::class, 'store'])->name('logo.store');
Route::get('/logo/edit/{id}', [App\Http\Controllers\LogoController::class, 'edit'])->name('logo.edit');
Route::post('/logo/update', [App\Http\Controllers\LogoController::class, 'update'])->name('logo.update');
Route::get('/logo/destroy/{id}', [App\Http\Controllers\LogoController::class, 'destroy'])->name('logo.destroy');
