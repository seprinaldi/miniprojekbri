<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KodeController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);

Route::get('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'auth']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [LoginController::class, 'register'])->middleware('guest');



Route::group(['middleware' => ['cekrole:Admin,Staff']], function () {
    Route::get('/data-asisten', [AsistenController::class, 'index']);
    Route::get('/data-asisten/create', [AsistenController::class, 'create']);
    Route::post('/data-asisten/create', [AsistenController::class, 'store']);
    Route::get('/data-asisten/edit/{id}', [AsistenController::class, 'edit']);
    Route::post('/data-asisten/edit/{id}', [AsistenController::class, 'update']);
    Route::delete('/data-asisten/delete/{id}', [AsistenController::class, 'destroy']);

    Route::get('/data-materi', [MateriController::class, 'index']);
    Route::get('/data-materi/create', [MateriController::class, 'create']);
    Route::post('/data-materi/create', [MateriController::class, 'store']);
    Route::get('/data-materi/edit/{id}', [MateriController::class, 'edit']);
    Route::post('/data-materi/edit/{id}', [MateriController::class, 'update']);
    
    Route::get('/data-kelas', [KelasController::class, 'index']);
    Route::get('/data-kelas/create', [KelasController::class, 'create']);
    Route::post('/data-kelas/create', [KelasController::class, 'store']);
    Route::get('/data-kelas/edit/{id}', [KelasController::class, 'edit']);
    Route::post('/data-kelas/edit/{id}', [KelasController::class, 'update']);

    Route::get('/absen-report', [AbsenController::class, 'index']);
});

Route::group(['middleware' => ['cekrole:Admin,Staff,PJ']], function () {
    Route::post('/code-generator/create', [KodeController::class, 'store']);
});

Route::group(['middleware' => ['cekrole:Admin,Staff,PJ,Asisten']], function () {
    Route::get('/code-generator', [KodeController::class, 'index']);
    Route::get('/absen-riwayat', [AbsenController::class, 'riwayat']);
    Route::post('/absen/create', [AbsenController::class, 'store']);
    Route::post('/absen/update', [AbsenController::class, 'update']);

});
