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
// home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Logo
Route::get('/logo', [App\Http\Controllers\LogoController::class, 'index'])->name('logo.index');
Route::post('/logo/store', [App\Http\Controllers\LogoController::class, 'store'])->name('logo.store');
Route::get('/logo/edit/{id}', [App\Http\Controllers\LogoController::class, 'edit'])->name('logo.edit');
Route::post('/logo/update', [App\Http\Controllers\LogoController::class, 'update'])->name('logo.update');
Route::get('/logo/destroy/{id}', [App\Http\Controllers\LogoController::class, 'destroy'])->name('logo.destroy');
// Server Device
Route::get('/server-device', [App\Http\Controllers\ServerDeviceController::class, 'index'])->name('server-device.index');
Route::post('/server-device/store', [App\Http\Controllers\ServerDeviceController::class, 'store'])->name('server-device.store');
Route::get('/server-device/edit/{id}', [App\Http\Controllers\ServerDeviceController::class, 'edit'])->name('server-device.edit');
Route::post('/server-device/update', [App\Http\Controllers\ServerDeviceController::class, 'update'])->name('server-device.update');
Route::get('/server-device/destroy/{id}', [App\Http\Controllers\ServerDeviceController::class, 'destroy'])->name('server-device.destroy');
// Server Akun
Route::get('/server-akun', [App\Http\Controllers\ServerAkunController::class, 'index'])->name('server-akun.index');
Route::post('/server-akun/store', [App\Http\Controllers\ServerAkunController::class, 'store'])->name('server-akun.store');
Route::get('/server-akun/edit/{id}', [App\Http\Controllers\ServerAkunController::class, 'edit'])->name('server-akun.edit');
Route::post('/server-akun/update', [App\Http\Controllers\ServerAkunController::class, 'update'])->name('server-akun.update');
Route::get('/server-akun/destroy/{id}', [App\Http\Controllers\ServerAkunController::class, 'destroy'])->name('server-akun.destroy');
// Rak Server
Route::get('/rak-server', [App\Http\Controllers\RakServerController::class, 'index'])->name('rak-server.index');
Route::post('/rak-server/store', [App\Http\Controllers\RakServerController::class, 'store'])->name('rak-server.store');
Route::get('/rak-server/edit/{id}', [App\Http\Controllers\RakServerController::class, 'edit'])->name('rak-server.edit');
Route::post('/rak-server/update', [App\Http\Controllers\RakServerController::class, 'update'])->name('rak-server.update');
Route::get('/rak-server/destroy/{id}', [App\Http\Controllers\RakServerController::class, 'destroy'])->name('rak-server.destroy');
// Rak Server Pengguna
Route::get('/rak-server-pengguna', [App\Http\Controllers\RakServerPenggunaController::class, 'index'])->name('rak-server-pengguna.index');
Route::post('/rak-server-pengguna/store', [App\Http\Controllers\RakServerPenggunaController::class, 'store'])->name('rak-server-pengguna.store');
Route::get('/rak-server-pengguna/edit/{id}', [App\Http\Controllers\RakServerPenggunaController::class, 'edit'])->name('rak-server-pengguna.edit');
Route::post('/rak-server-pengguna/update', [App\Http\Controllers\RakServerPenggunaController::class, 'update'])->name('rak-server-pengguna.update');
Route::get('/rak-server-pengguna/destroy/{id}', [App\Http\Controllers\RakServerPenggunaController::class, 'destroy'])->name('rak-server-pengguna.destroy');
// Desktop Device
Route::get('/desktop-device', [App\Http\Controllers\DesktopDeviceController::class, 'index'])->name('desktop-device.index');
Route::post('/desktop-device/store', [App\Http\Controllers\DesktopDeviceController::class, 'store'])->name('desktop-device.store');
Route::get('/desktop-device/edit/{id}', [App\Http\Controllers\DesktopDeviceController::class, 'edit'])->name('desktop-device.edit');
Route::post('/desktop-device/update', [App\Http\Controllers\DesktopDeviceController::class, 'update'])->name('desktop-device.update');
Route::get('/desktop-device/destroy/{id}', [App\Http\Controllers\DesktopDeviceController::class, 'destroy'])->name('desktop-device.destroy');
// Desktop Pengguna
Route::get('/desktop-pengguna', [App\Http\Controllers\DesktopPenggunaController::class, 'index'])->name('desktop-pengguna.index');
Route::post('/desktop-pengguna/store', [App\Http\Controllers\DesktopPenggunaController::class, 'store'])->name('desktop-pengguna.store');
Route::get('/desktop-pengguna/edit/{id}', [App\Http\Controllers\DesktopPenggunaController::class, 'edit'])->name('desktop-pengguna.edit');
Route::post('/desktop-pengguna/update', [App\Http\Controllers\DesktopPenggunaController::class, 'update'])->name('desktop-pengguna.update');
Route::get('/desktop-pengguna/destroy/{id}', [App\Http\Controllers\DesktopPenggunaController::class, 'destroy'])->name('desktop-pengguna.destroy');
// Network Device
Route::get('/network-device', [App\Http\Controllers\NetworkDeviceController::class, 'index'])->name('network-device.index');
Route::post('/network-device/store', [App\Http\Controllers\NetworkDeviceController::class, 'store'])->name('network-device.store');
Route::get('/network-device/edit/{id}', [App\Http\Controllers\NetworkDeviceController::class, 'edit'])->name('network-device.edit');
Route::post('/network-device/update', [App\Http\Controllers\NetworkDeviceController::class, 'update'])->name('network-device.update');
Route::get('/network-device/destroy/{id}', [App\Http\Controllers\NetworkDeviceController::class, 'destroy'])->name('network-device.destroy');
// SSID WIFI
Route::get('/ssid-wifi', [App\Http\Controllers\SsidWifiController::class, 'index'])->name('ssid-wifi.index');
Route::post('/ssid-wifi/store', [App\Http\Controllers\SsidWifiController::class, 'store'])->name('ssid-wifi.store');
Route::get('/ssid-wifi/edit/{id}', [App\Http\Controllers\SsidWifiController::class, 'edit'])->name('ssid-wifi.edit');
Route::post('/ssid-wifi/update', [App\Http\Controllers\SsidWifiController::class, 'update'])->name('ssid-wifi.update');
Route::get('/ssid-wifi/destroy/{id}', [App\Http\Controllers\SsidWifiController::class, 'destroy'])->name('ssid-wifi.destroy');
// Printer Device
Route::get('/printer-device', [App\Http\Controllers\PrinterDeviceController::class, 'index'])->name('printer-device.index');
Route::post('/printer-device/store', [App\Http\Controllers\PrinterDeviceController::class, 'store'])->name('printer-device.store');
Route::get('/printer-device/edit/{id}', [App\Http\Controllers\PrinterDeviceController::class, 'edit'])->name('printer-device.edit');
Route::post('/printer-device/update', [App\Http\Controllers\PrinterDeviceController::class, 'update'])->name('printer-device.update');
Route::get('/printer-device/destroy/{id}', [App\Http\Controllers\PrinterDeviceController::class, 'destroy'])->name('printer-device.destroy');
// Printer Pengguna
Route::get('/printer-pengguna', [App\Http\Controllers\PrinterPenggunaController::class, 'index'])->name('printer-pengguna.index');
Route::post('/printer-pengguna/store', [App\Http\Controllers\PrinterPenggunaController::class, 'store'])->name('printer-pengguna.store');
Route::get('/printer-pengguna/edit/{id}', [App\Http\Controllers\PrinterPenggunaController::class, 'edit'])->name('printer-pengguna.edit');
Route::post('/printer-pengguna/update', [App\Http\Controllers\PrinterPenggunaController::class, 'update'])->name('printer-pengguna.update');
Route::get('/printer-pengguna/destroy/{id}', [App\Http\Controllers\PrinterPenggunaController::class, 'destroy'])->name('printer-pengguna.destroy');
// Users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('/users/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::get('/users/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');