<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [HomeController::class, 'login']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('siswa')->group(function () {
  Route::get('/user_setting', [HomeController::class, 'user_profile'])->name('HalamanUserSetting');
  Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::get('/', [HomeController::class, 'dashboard'])->name('HalamanDashboard');
// data siswa
Route::get('/siswa', [HomeController::class, 'data_siswa'])->name('DataSiswa');
Route::post('/siswa', [InputController::class, 'data_siswa'])->name('TampilTabel');
Route::put('/edit_siswa/{id}', [InputController::class, 'edit_siswa'])->name('EditSiswa');
Route::delete('/siswa/{id}', [InputController::class, 'delete_siswa'])->name('DeleteSiswa');
// tambah siswa
Route::get('/tambah_siswa', [HomeController::class, 'tambah_siswa'])->name('TambahDataSiswa');
Route::post('/tambah_siswa', [InputController::class, 'input_siswa'])->name('InputSiswa');
Route::post('/upload_siswa', [InputController::class, 'upload_siswa'])->name('UploadSiswa');
// tambah kelas
Route::get('/tambah_kelas', [HomeController::class, 'tambah_kelas'])->name('TambahKelas');
Route::post('/tambah_kelas', [InputController::class, 'input_kelas'])->name('InputTambahKelas');
Route::put('/edit_kelas/{id}', [InputController::class, 'edit_kelas'])->name('EditKelas');
Route::delete('/kelas/{id}', [InputController::class, 'delete_kelas'])->name('DeleteKelas');
