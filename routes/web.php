<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputController;
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

Route::get('/user_setting', [HomeController::class, 'user_profile'])->name('HalamanUserSetting');
Route::get('/', [HomeController::class, 'dashboard'])->name('HalamanDashboard');
Route::get('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register']);
// data siswa
Route::get('/siswa', [HomeController::class, 'data_siswa'])->name('DataSiswa');
// tambah siswa
Route::get('/tambah_siswa', [HomeController::class, 'tambah_siswa'])->name('TambahDataSiswa');
Route::post('/tambah_siswa', [InputController::class, 'input_siswa'])->name('InputSiswa');
// tambah kelas
Route::get('/tambah_kelas', [HomeController::class, 'tambah_kelas'])->name('TambahKelas');
Route::post('/tambah_kelas', [InputController::class, 'input_kelas'])->name('InputTambahKelas');