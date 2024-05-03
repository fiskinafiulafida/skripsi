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
use App\Http\Controllers\ProfController;
use App\Http\Controllers\PassController;
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
// Route::resource('/kandangAdmin', KandangController::class)->middleware('auth', 'checkrole:admin');
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/kandangAdmin', KandangController::class);
});

// data produksi telur ayam
// Route::resource('/produksiTelur', ProduksiController::class)->middleware('auth', 'checkrole:admin');
// Route::post('/filterKandang', [ProduksiController::class, 'filterKandang']);;
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/produksiTelur', ProduksiController::class);
    Route::post('/filterKandang', [ProduksiController::class, 'filterKandang']);
});

// data user
// Route::resource('/user', UserController::class)->middleware('auth', 'checkrole:admin');
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/user', UserController::class);
});

// data tahun produksi telur ayam
// Route::resource('/tahunProduksiAdmin', TahunProduksiController::class)->middleware('auth', 'checkrole:admin');
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/tahunProduksiAdmin', TahunProduksiController::class);
});

// peramalan produksi telur ayam
// Route::resource('/peramalanAdmin', PeramalanController::class)->middleware('auth', 'checkrole:admin');
// Route::post('/getData', [PeramalanController::class, 'forecast']);
// Route::post('/clear-records', [PeramalanController::class, 'destroy']);
// Route::get('/result-view', [PeramalanController::class, 'resultData']);
// Route::post('/getResult', [PeramalanController::class, 'generateForecast']);
// Route::post('/clearResult', [PeramalanController::class, 'destroyResult']);
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/peramalanAdmin', PeramalanController::class);
    Route::post('/getData', [PeramalanController::class, 'forecast']);
    Route::post('/clear-records', [PeramalanController::class, 'destroy']);
    Route::get('/result-view', [PeramalanController::class, 'resultData']);
    Route::post('/getResult', [PeramalanController::class, 'generateForecast']);
    Route::post('/clearResult', [PeramalanController::class, 'destroyResult']);
});

// peramalan pemilik 
// Route::get('/hasilPeramalanowner', [PeramalanController::class, 'resultData2']);
// Route::post('/getResult2', [PeramalanController::class, 'generateForecast2']);
// Route::post('/clearResult2', [PeramalanController::class, 'destroyResult2']);
Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::get('/hasilPeramalanowner', [PeramalanController::class, 'resultData2']);
    Route::post('/getResult2', [PeramalanController::class, 'generateForecast2']);
    Route::post('/clearResult2', [PeramalanController::class, 'destroyResult2']);
});

// Halaman Owner
Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::get('/dashboardowner', [OwnerController::class, 'index']);
});

// Halaman Profile User
// Route::resource('/profile', ProfileController::class)->middleware('auth', 'checkrole:admin,owner');
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/profile', ProfileController::class);
});

// Password
// Route::resource('/password', PasswordController::class)->middleware('auth');
// Route::post('/change-password', [App\Http\Controllers\PasswordController::class, 'update'])->name('update-password')->middleware('auth');
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::resource('/password', PasswordController::class);
    Route::post('/change-password', [App\Http\Controllers\PasswordController::class, 'update'])->name('update-password')->middleware('auth');
});

// filter halaman dashboard
// Route::get('/filterGrafik', [AdminController::class, 'getChartData']);
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::get('/filterGrafik', [AdminController::class, 'getChartData']);
});

// filter halaman owner
// Route::get('/filterGrafikowner', [OwnerController::class, 'getChartData']);
Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::get('/filterGrafikowner', [OwnerController::class, 'getChartData']);
});
// produksi telur owner
// Route::get('produksiTelurowner', [ProduksiController::class, 'getProduksiOwner']);
// Route::post('/filterKandangOWner', [ProduksiController::class, 'filterKandangowner']);
Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::get('produksiTelurowner', [ProduksiController::class, 'getProduksiOwner']);
    Route::post('/filterKandangOWner', [ProduksiController::class, 'filterKandangowner']);
});

// filter peramalan hasil produksi telur ayam admin
// Route::get('/filter', [PeramalanController::class, 'chart']);
Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::get('/filter', [PeramalanController::class, 'chart']);
});

// Route::get('/grafik', [PeramalanController::class, 'grafikPemilik']);
Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::get('/grafik', [PeramalanController::class, 'grafikPemilik']);
});

Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::resource('/profilePemilik', ProfController::class);
});

Route::group(['middleware' => ['auth', 'checkrole:owner']], function () {
    Route::resource('/passwordPemilik', PassController::class);
    Route::post('/change-password', [App\Http\Controllers\PassController::class, 'update'])->name('update-password')->middleware('auth');
});
