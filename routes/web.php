<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [HomeController::class, 'login']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('siswa')->group(function () {
    Route::get('/user_setting', [HomeController::class, 'user_profile'])->name('HalamanUserSetting');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/bayar', [PembayaranController::class, 'proses'])->name('proses-checkout');
    Route::get('/checkout', [PembayaranController::class, 'tampilan_checkout'])->name('tampilan_checkout');
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
// pembayaran spp (admin)
Route::get('/pembayaran_spp', [HomeController::class, 'pembayaran_spp_admin'])->name('PembayaranSPP');
Route::post('/pembayaran_spp', [InputController::class, 'input_spp'])->name('InputSPP');
Route::put('/update_pembayaran_spp', [InputController::class, 'update_spp'])->name('UpdateSPP');
Route::post('/input_tahun_ajaran', [InputController::class, 'input_tahun_Ajaran'])->name('InputTahunAjaran');
Route::put('/update_tahun_ajaran', [InputController::class, 'update_tahun_ajaran_aktif'])->name('UpdateTahunAjaran');
Route::post('/clear_form_tahun_ajaran', [InputController::class, 'clear'])->name('ClearForm');
Route::put('/edit_tahun_ajaran/{id}', [InputController::class, 'edit_tahun_ajaran'])->name('EditTahunAjaran');
Route::delete('/hapus_tahun_ajaran/{id}', [InputController::class, 'delete_tahun_ajaran'])->name('HapusTahunAjaran');
Route::post('/tahun_ajaran_aktif', [InputController::class, 'tahun_ajaran_aktif'])->name('TahunAjaranAktif');
