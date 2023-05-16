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
// aksesoris Device
Route::get('/aksesoris-device', [App\Http\Controllers\AksesorisDeviceController::class, 'index'])->name('aksesoris-device.index');
Route::post('/aksesoris-device/store', [App\Http\Controllers\AksesorisDeviceController::class, 'store'])->name('aksesoris-device.store');
Route::get('/aksesoris-device/edit/{id}', [App\Http\Controllers\AksesorisDeviceController::class, 'edit'])->name('aksesoris-device.edit');
Route::post('/aksesoris-device/update', [App\Http\Controllers\AksesorisDeviceController::class, 'update'])->name('aksesoris-device.update');
Route::get('/aksesoris-device/destroy/{id}', [App\Http\Controllers\AksesorisDeviceController::class, 'destroy'])->name('aksesoris-device.destroy');
// aksesoris Pengguna
Route::get('/aksesoris-pengguna', [App\Http\Controllers\AksesorisPenggunaController::class, 'index'])->name('aksesoris-pengguna.index');
Route::post('/aksesoris-pengguna/store', [App\Http\Controllers\AksesorisPenggunaController::class, 'store'])->name('aksesoris-pengguna.store');
Route::get('/aksesoris-pengguna/detail/{id}', [App\Http\Controllers\AksesorisPenggunaController::class, 'detail'])->name('aksesoris-pengguna.detail');
Route::get('/aksesoris-pengguna/edit/{id}', [App\Http\Controllers\AksesorisPenggunaController::class, 'edit'])->name('aksesoris-pengguna.edit');
Route::post('/aksesoris-pengguna/update', [App\Http\Controllers\AksesorisPenggunaController::class, 'update'])->name('aksesoris-pengguna.update');
Route::get('/aksesoris-pengguna/destroy/{id}', [App\Http\Controllers\AksesorisPenggunaController::class, 'destroy'])->name('aksesoris-pengguna.destroy');
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
// Lisensi Software
Route::get('/lisensi-software', [App\Http\Controllers\LisensiSoftwareController::class, 'index'])->name('lisensi-software.index');
Route::post('/lisensi-software/store', [App\Http\Controllers\LisensiSoftwareController::class, 'store'])->name('lisensi-software.store');
Route::get('/lisensi-software/edit/{id}', [App\Http\Controllers\LisensiSoftwareController::class, 'edit'])->name('lisensi-software.edit');
Route::post('/lisensi-software/update', [App\Http\Controllers\LisensiSoftwareController::class, 'update'])->name('lisensi-software.update');
Route::get('/lisensi-software/destroy/{id}', [App\Http\Controllers\LisensiSoftwareController::class, 'destroy'])->name('lisensi-software.destroy');
// Lisensi Software Pengguna
Route::get('/lisensi-software-pengguna', [App\Http\Controllers\LisensiSoftwarePenggunaController::class, 'index'])->name('lisensi-software-pengguna.index');
Route::post('/lisensi-software-pengguna/store', [App\Http\Controllers\LisensiSoftwarePenggunaController::class, 'store'])->name('lisensi-software-pengguna.store');
Route::get('/lisensi-software-pengguna/detail/{id}', [App\Http\Controllers\LisensiSoftwarePenggunaController::class, 'detail'])->name('lisensi-software-pengguna.detail');
Route::get('/lisensi-software-pengguna/edit/{id}', [App\Http\Controllers\LisensiSoftwarePenggunaController::class, 'edit'])->name('lisensi-software-pengguna.edit');
Route::post('/lisensi-software-pengguna/update', [App\Http\Controllers\LisensiSoftwarePenggunaController::class, 'update'])->name('lisensi-software-pengguna.update');
Route::get('/lisensi-software-pengguna/destroy/{id}', [App\Http\Controllers\LisensiSoftwarePenggunaController::class, 'destroy'])->name('lisensi-software-pengguna.destroy');
// Logo
Route::get('/logo', [App\Http\Controllers\LogoController::class, 'index'])->name('logo.index');
Route::post('/logo/store', [App\Http\Controllers\LogoController::class, 'store'])->name('logo.store');
Route::get('/logo/edit/{id}', [App\Http\Controllers\LogoController::class, 'edit'])->name('logo.edit');
Route::post('/logo/update', [App\Http\Controllers\LogoController::class, 'update'])->name('logo.update');
Route::get('/logo/destroy/{id}', [App\Http\Controllers\LogoController::class, 'destroy'])->name('logo.destroy');
// Network Device
Route::get('/network-device', [App\Http\Controllers\NetworkDeviceController::class, 'index'])->name('network-device.index');
Route::post('/network-device/store', [App\Http\Controllers\NetworkDeviceController::class, 'store'])->name('network-device.store');
Route::get('/network-device/edit/{id}', [App\Http\Controllers\NetworkDeviceController::class, 'edit'])->name('network-device.edit');
Route::post('/network-device/update', [App\Http\Controllers\NetworkDeviceController::class, 'update'])->name('network-device.update');
Route::get('/network-device/destroy/{id}', [App\Http\Controllers\NetworkDeviceController::class, 'destroy'])->name('network-device.destroy');
// Network Device
Route::get('/network-akses', [App\Http\Controllers\NetworkAksesController::class, 'index'])->name('network-akses.index');
Route::post('/network-akses/store', [App\Http\Controllers\NetworkAksesController::class, 'store'])->name('network-akses.store');
Route::get('/network-akses/detail/{id}', [App\Http\Controllers\NetworkAksesController::class, 'edit'])->name('network-akses.detail');
Route::get('/network-akses/edit/{id}', [App\Http\Controllers\NetworkAksesController::class, 'edit'])->name('network-akses.edit');
Route::post('/network-akses/update', [App\Http\Controllers\NetworkAksesController::class, 'update'])->name('network-akses.update');
Route::get('/network-akses/destroy/{id}', [App\Http\Controllers\NetworkAksesController::class, 'destroy'])->name('network-akses.destroy');
// Network lokasi
Route::get('/network-lokasi', [App\Http\Controllers\NetworkLokasiController::class, 'index'])->name('network-lokasi.index');
Route::post('/network-lokasi/store', [App\Http\Controllers\NetworkLokasiController::class, 'store'])->name('network-lokasi.store');
Route::get('/network-lokasi/detail/{id}', [App\Http\Controllers\NetworkLokasiController::class, 'detail'])->name('network-lokasi.detail');
Route::get('/network-lokasi/edit/{id}', [App\Http\Controllers\NetworkLokasiController::class, 'edit'])->name('network-lokasi.edit');
Route::post('/network-lokasi/update', [App\Http\Controllers\NetworkLokasiController::class, 'update'])->name('network-lokasi.update');
Route::get('/network-lokasi/destroy/{id}', [App\Http\Controllers\NetworkLokasiController::class, 'destroy'])->name('network-lokasi.destroy');
// Printer Device
Route::get('/printer-device', [App\Http\Controllers\PrinterDeviceController::class, 'index'])->name('printer-device.index');
Route::post('/printer-device/store', [App\Http\Controllers\PrinterDeviceController::class, 'store'])->name('printer-device.store');
Route::get('/printer-device/edit/{id}', [App\Http\Controllers\PrinterDeviceController::class, 'edit'])->name('printer-device.edit');
Route::post('/printer-device/update', [App\Http\Controllers\PrinterDeviceController::class, 'update'])->name('printer-device.update');
Route::get('/printer-device/destroy/{id}', [App\Http\Controllers\PrinterDeviceController::class, 'destroy'])->name('printer-device.destroy');
// Printer Pengguna
Route::get('/printer-pengguna', [App\Http\Controllers\PrinterPenggunaController::class, 'index'])->name('printer-pengguna.index');
Route::post('/printer-pengguna/store', [App\Http\Controllers\PrinterPenggunaController::class, 'store'])->name('printer-pengguna.store');
Route::get('/printer-pengguna/detail/{id}', [App\Http\Controllers\PrinterPenggunaController::class, 'detail'])->name('printer-pengguna.detail');
Route::get('/printer-pengguna/edit/{id}', [App\Http\Controllers\PrinterPenggunaController::class, 'edit'])->name('printer-pengguna.edit');
Route::post('/printer-pengguna/update', [App\Http\Controllers\PrinterPenggunaController::class, 'update'])->name('printer-pengguna.update');
Route::get('/printer-pengguna/destroy/{id}', [App\Http\Controllers\PrinterPenggunaController::class, 'destroy'])->name('printer-pengguna.destroy');
// Rak Lokasi
Route::get('/rak-server-lokasi', [App\Http\Controllers\RakServerLokasiController::class, 'index'])->name('rak-server-lokasi.index');
Route::post('/rak-server-lokasi/store', [App\Http\Controllers\RakServerLokasiController::class, 'store'])->name('rak-server-lokasi.store');
Route::get('/rak-server-lokasi/edit/{id}', [App\Http\Controllers\RakServerLokasiController::class, 'edit'])->name('rak-server-lokasi.edit');
Route::post('/rak-server-lokasi/update', [App\Http\Controllers\RakServerLokasiController::class, 'update'])->name('rak-server-lokasi.update');
Route::get('/rak-server-lokasi/destroy/{id}', [App\Http\Controllers\RakServerLokasiController::class, 'destroy'])->name('rak-server-lokasi.destroy');
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
// SSID WIFI
Route::get('/ssid-wifi', [App\Http\Controllers\SsidWifiController::class, 'index'])->name('ssid-wifi.index');
Route::post('/ssid-wifi/store', [App\Http\Controllers\SsidWifiController::class, 'store'])->name('ssid-wifi.store');
Route::get('/ssid-wifi/edit/{id}', [App\Http\Controllers\SsidWifiController::class, 'edit'])->name('ssid-wifi.edit');
Route::post('/ssid-wifi/update', [App\Http\Controllers\SsidWifiController::class, 'update'])->name('ssid-wifi.update');
Route::get('/ssid-wifi/destroy/{id}', [App\Http\Controllers\SsidWifiController::class, 'destroy'])->name('ssid-wifi.destroy');
// Users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('/users/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::get('/users/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
// User divisi
Route::get('/users-divisi', [App\Http\Controllers\UserDivisiController::class, 'index'])->name('users-divisi.index');
Route::post('/users-divisi/store', [App\Http\Controllers\UserDivisiController::class, 'store'])->name('users-divisi.store');
Route::get('/users-divisi/edit/{id}', [App\Http\Controllers\UserDivisiController::class, 'edit'])->name('users-divisi.edit');
Route::post('/users-divisi/update', [App\Http\Controllers\UserDivisiController::class, 'update'])->name('users-divisi.update');
Route::get('/users-divisi/destroy/{id}', [App\Http\Controllers\UserDivisiController::class, 'destroy'])->name('users-divisi.destroy');