<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PeramalanController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TahunProduksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Auth;

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

// Login dan Register
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/', [LoginController::class, 'dologin']);
});

Route::resource('/register', RegisterController::class)->middleware('guest');

// guest yang akan melakukan logout
Route::group(['middleware' => ['auth', 'checkrole:admin,owner,pegawai']], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/redirect', [LoginController::class, 'cek']);
});
// Halaman Admin
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::get('/dashboardAdmin', [AdminController::class, 'index']);
});

// data kandang ayam 
Route::resource('/kandangAdmin', KandangController::class)->middleware('auth', 'checkrole:admin');

// data produksi telur ayam
Route::resource('/produksiTelur', ProduksiController::class)->middleware('auth', 'checkrole:admin');

// data user
Route::resource('/user', UserController::class)->middleware('auth', 'checkrole:admin');

// data tahun produksi telur ayam
Route::resource('/tahunProduksiAdmin', TahunProduksiController::class)->middleware('auth', 'checkrole:admin');

// peramalan produksi telur ayam
Route::resource('/peramalanAdmin', PeramalanController::class)->middleware('auth', 'checkrole:admin');
Route::post('/getData', [PeramalanController::class, 'getDataform']);
Route::post('/getData', [PeramalanController::class, 'forecast']);
Route::post('/clear-records', [PeramalanController::class, 'destroy']);
Route::get('/result-view', [PeramalanController::class, 'resultData']);
Route::post('/getResult', [PeramalanController::class, 'generateForecast']);
Route::post('/clear-records2', [PeramalanController::class, 'destroy2']);

// Halaman Owner
Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::get('/dashboardowner', [OwnerController::class, 'index']);
});

// Halaman Profile User
Route::resource('/profile', ProfileController::class)->middleware('auth', 'checkrole:admin,owner');

// Password
Route::resource('/password', PasswordController::class)->middleware('auth');
Route::post('/change-password', [App\Http\Controllers\PasswordController::class, 'update'])->name('update-password')->middleware('auth');
